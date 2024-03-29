<?php
Kirby::plugin('kirbyzone/sitemapper', [
    'options' => [
        // colour options that can be used to customise sitemap apparance in the browser:
        'bgClr' => false, //page background colour
        'txtClr' => false, // normal text colour
        'titleClr' => false, // colour of page title
        'badgeBgClr' => false, // background colour of pill-shaped badges shown next to page title
        'badgeTxtClr' => false, // text colour of pill-shaped badges shown next to page title
        'dividerClr' => false, // colour of divider line below the title, and at the bottom of page
        'thClr' => false, // colour of text in the table column headings
        'rowBorderClr' => false, // colour of border between table rows
        'rowHoverClr' => false, // background colour of table rows when hovered
        'linkClr' => false, // colour of all links on the page
        'linkHoverClr' => false, // colour of links when hovered
        'btnBgClr' => false, // background colour of disclosure buttons
        'btnBgHoverClr' => false, // background colour of disclosure buttons when hovered
        'btnIconClr' => false, // colour of disclosure arrow icon inside disclosure buttons
        'btnIconHoverClr' => false, // colour of disclosure arrow icon when hovered
        'urlIconClr' => false, // colour of icon shown before page/image url
        'urlTagClr' => false, // colour of language tag shown after page url
        // title at the top of the sitemap:
        'title' => 'Sitemap',
        // introductory text that appears below the title - use [[count]] to display URL count:
        'intro' => 'Sitemaps are used by search engines to find and classify the content of you website - more information at <a href="https://sitemaps.org">sitemaps.org</a>. This page displays the sitemap after it has been transformed into a more human-readable format. This sitemap contains <strong>[[count]]</strong> URLs.',
        // string for 'images' pill at top of map:
        'imagesStr' => 'images',
        // string for 'alternates' pill at top of map"
        'alternatesStr' => 'alternates',
        // heading of URL column:
        'urlStr' => 'URL',
        // heading of 'Last Modified' column:
        'lastModStr' => 'Last Modified',
        // by-line which is shown at the bottom of the map:
        'byLine' => 'This sitemap is automatically generated and displays all website content.',
        // optional closure to use for filtering pages out of the sitemap:
        'pageFilter' => false,
        'extraPages'=>function($s){
            return [];
        },
        // closure to use as mapping function to generate sitemap:
        'customMap' => function($s){
            // get list of all top-level published pages in the site:
            $pages = $s->pages()->published();
            // start with an empty array:
            $map = [];
            foreach ($pages as $p) {
                $map = array_merge_recursive($map,$p->sitemapPageArray());
            }
            return $map;
        }
    ],

    // we include a simple 'sitemap' field blueprint, to make it easier for users
    // to add it to their pages and files blueprints, if they want:
    'blueprints' => [
            'fields/sitemap' => __DIR__ . '/blueprints/sitemap.yml'
    ],

    'pageMethods' => [
        // Function used to determine the 'mode' of the page, set via blueprint option.
        // Returns a string: the sitemap mode, if set in the blueprint, or 'show' (default).
        'sitemapMode' => function(){
            return $this->blueprint()->options()['sitemap'] ?? 'show';
        },
        // Function which calculates whether a page should appear or not in the sitemap.
        // Calculation is based on whether the page or any of its parents has a 'hide' mode
        // in their blueprint, as well as on whether the page has a 'sitemap' field with a
        // boolean value of false (a toggle to hide the specific page).
        // Param $code should be the page's language code in a multilingual site. If no $code
        // is given, then the default language is used - e.g., in single-language sites.
        // Returns TRUE if the page should appear on the map, and FALSE if it should be hidden.
        'showInSitemap' => function($code = false){
            // if the page is the Error Page, it should be hidden:
            if($this->isErrorPage()){ return false; }
            // if the page's sitemap mode is 'hide', it should be hidden:
            if($this->sitemapMode() == 'hide'){ return false; }
            // if any of the page's parents' mode is 'hide', it should also be hidden:
            foreach ($this->parents() as $parent) {
                if($parent->sitemapMode() == 'hide'){ return false; }
            }
            // then, we apply any user-defined filter:
            $filter = option('kirbyzone.sitemapper.pageFilter');
            if(is_callable($filter) and !$filter($this)){ return false; }
            // finally, if the page has a 'sitemap' field, it should determine
            // whether the page should be included:
            if($this->sitemap()->exists()){
                if(!kirby()->option('languages',false)){
                    // site is single-language:
                    return $this->sitemap()->toBool();
                } else {
                    // site is multilingual:
                    if($code == false){ $code = kirby()->defaultLanguage()->code(); }
                    try {
                        $bool = $this->content($code)->sitemap();
                    } catch (Exception $error) {
                        $bool = $this->content(kirby()->defaultLanguage()->code())->sitemap();
                    }
                    return $bool->toBool();
                }

            }
            // otherwise, we assume the page SHOULD be included:
            return true;
        },
        // this function returns a list of all images that need to be added to the sitemap,
        // for the current page. It includes the page's own images, as well as the images of
        // any children with sitemap option set to 'images' - recursively.
        'sitemapPageImages' => function($code = false){
            $images = [];
            foreach ($this->images() as $img) {
                if($img->showInSitemap($code)){ $images[] = $img->url(); }
            }
            foreach ($this->children()->published() as $child) {
                if($child->sitemapMode() == 'images' and $child->showInSitemap($code)){
                    $images = array_merge($images,$child->sitemapPageImages($code));
                }
            }
            return $images;
        },
        // Recursive function returns all page info relevant to be added to the sitemap,
        // for the current page as well as all its children, as an array.
        // Returns an array in the following format:
        // [
        //      'http://example.com' => [                   // key is the page URL in the map
        //          'mod' => '2019-06-17T16:25:31+02:00',   // last modified date for the page
        //          'lang' => [                             // optional - alternative languages
        //              'en' => [                           // key is language code
        //                  'locale' => 'en-AU',            // locale of this version
        //                  'url'=> 'http://example.com/en' // url for this version
        //              ]
        //          ],
        //          'images' => []                          // list of images for the page
        //      ]
        // ]
        // If a page is multilingual, the array will have several entries - one for each URL
        // of the page, in each language. If a page is single-language, the array will have
        // only one entry for it.
        'sitemapPageArray' => function(){
            $pgMap = []; // we start with an empty map;
            $mode = $this->sitemapMode();
            if(kirby()->option('languages',false) and $mode == 'show') {
                // PAGE IS MULTILINGUAL
                // - i.e., it will have versions in all available languages.
                // We start by checking what content translations we actually have:
                $langs = [];
                foreach (kirby()->languages() as $lang){
                    if(!empty(F::modified($this->contentFile($lang->code())))) { $langs[] = $lang; }
                }
                // add the existing language page URLs to the sitemap:
                foreach ($langs as $lang) {
                    $code = $lang->code();
                    // check whether the page should be included in sitemap:
                    if(!$this->showInSitemap($code)){ continue; }
                    $url = $this->url($code);
                    $pgMap[$url]['mod'] = F::modified($this->contentFile($code),'c','date');
                    $pgMap[$url]['lang'] = [];
                    foreach ($langs as $l) {
                        // try to get the locale set by the user -
                        // if not available, use language code as fallback::
                        $locale = $l->locale(LC_ALL) ?? $l->code();
                        // if locale has been set as a system file -
                        // "en_US.UTF-8" - we get rid of the extension:
                        $locale = pathinfo($locale,PATHINFO_FILENAME);
                        $pgMap[$url]['lang'][$l->code()]['locale'] = $locale;
                        $pgMap[$url]['lang'][$l->code()]['url'] = $this->url($l->code());
                    }
                    // add the 'default' language fallback:
                    $pgMap[$url]['lang']['x-default']['locale'] = 'x-default';
                    $pgMap[$url]['lang']['x-default']['url'] = $this->url(kirby()->defaultLanguage()->code());
                    // add page's images:
                    $pgMap[$url]['images'] = $this->sitemapPageImages($code);
                    foreach ($this->children()->published() as $child) {
                        if($child->sitemapMode() == 'images') {
                            $pgMap[$url]['images'] = array_merge($pgMap[$url]['images'], $child->sitemapPageImages($code));
                        }
                    }
                }
            } else {
                // PAGE IS SINGLE-LANGUAGE
                // - i.e., it should have only one version, in one language:
                // check whether page should be included in sitemap:
                if($this->showInSitemap()) {
                    if(kirby()->option('languages',false)){
                        // THIS IS A SINGLE-LANGUAGE PAGE IN A MULTILINGUAL SITE:
                        $code = $this->sitemapMode();
                        $url = $this->url($code);
                    } else {
                        // THIS IS A SINGLE-LANGUAGE SITE:
                        $code = false;
                        $url = $this->url();
                    }
                    $pgMap[$url]['mod'] = $this->modified('c','date');
                    $pgMap[$url]['lang'] = []; // empty array == no language alternatives
                    // add page's images:
                    $pgMap[$url]['images'] = $this->sitemapPageImages();
                    foreach ($this->children()->published() as $child) {
                        if($child->sitemapMode() == 'images'){
                            $pgMap[$url]['images'] = array_merge($pgMap[$url]['images'], $child->sitemapPageImages($code));
                        }
                    }
                }
            }
            // lastly, we iterate recursively through the children:
            foreach ($this->children()->published() as $child) {
                if($child->sitemapMode() != 'images') {
                    $pgMap = array_merge_recursive($pgMap,$child->sitemapPageArray());
                }
            }
            return $pgMap;
        }
    ],

    'fileMethods' => [
        'showInSitemap' => function($code = false){
            // if the image file blueprint has a 'sitemap' field, we use it to determine
            // whether the image should be included:
            if($this->sitemap()->exists()){
                if(!kirby()->option('languages',false)){
                    // site is single-language:
                    return $this->sitemap()->toBool();
                } else {
                    // site is multilingual:
                    if($code == false){ $code = kirby()->defaultLanguage()->code(); }
                    try {
                        $bool = $this->content($code)->sitemap();
                    } catch (Exception $error) {
                        $bool = $this->content(kirby()->defaultLanguage()->code())->sitemap();
                    }
                    return $bool->toBool();
                }

            }
            // otherwise, we assume the image SHOULD be included:
            return true;
        }
    ],

    'routes' => [
        [
            'pattern' => 'sitemap.xml',
            'action' => function(){
                // get function that will be used to generate sitemap::
                $mapper = option('kirbyzone.sitemapper.customMap');
                // generate sitemap:
                $map = $mapper(site());
                $hasExtraPages = option('kirbyzone.sitemapper.extraPages');
                if(is_callable($hasExtraPages)){
                    $extra = $hasExtraPages(site());
                   $map = array_merge($map, $extra);
                }
                //build the xml document:
                $content = snippet('sitemapper/xml', ['map' => $map], true);
                // return response with correct header type
                return new Kirby\Cms\Response($content, 'application/xml');
            }
        ],
        [
            'pattern' => ['(:all)/sitemap','(:all)/sitemap.xml'],
            'action'  => function(){
              return go('sitemap.xml', 301);
            }
        ],
        [
            'pattern' => 'sitemap.xsl',
            'action' => function(){
                //build the xml document:
                $data = snippet('sitemapper/xsl',[], true);
                // return response with correct header type
                return new Kirby\Cms\Response($data, 'application/xslt+xml');
            }
        ],
        [
            'pattern' => ['(:all)/sitemap.xsl'],
            'action'  => function(){
              return go('sitemap.xsl', 301);
            }
        ]
    ],

    // our XML and XSL templates:
    'snippets' => [
        'sitemapper/xml' => __DIR__ . '/snippets/xml.php',
        'sitemapper/xsl' => __DIR__ . '/snippets/xsl.php'
    ]
]);
