/*! zero v1.1.0 | (c) 2022 Branko Matic | GPL-2.0-or-later License | https://www.thezero.club/ */
(function () {
	'use strict';

	function getDefaultExportFromCjs (x) {
		return x && x.__esModule && Object.prototype.hasOwnProperty.call(x, 'default') ? x['default'] : x;
	}

	function getAugmentedNamespace(n) {
		if (n.__esModule) return n;
		var a = Object.defineProperty({}, '__esModule', {value: true});
		Object.keys(n).forEach(function (k) {
			var d = Object.getOwnPropertyDescriptor(n, k);
			Object.defineProperty(a, k, d.get ? d : {
				enumerable: true,
				get: function () {
					return n[k];
				}
			});
		});
		return a;
	}

	var lib$6 = {};

	/** Keeps track of raw listeners added to the base elements to avoid duplication */
	const ledger = new WeakMap();
	function editLedger(wanted, baseElement, callback, setup) {
	    var _a, _b;
	    if (!wanted && !ledger.has(baseElement)) {
	        return false;
	    }
	    const elementMap = (_a = ledger.get(baseElement)) !== null && _a !== void 0 ? _a : new WeakMap();
	    ledger.set(baseElement, elementMap);
	    if (!wanted && !ledger.has(baseElement)) {
	        return false;
	    }
	    const setups = (_b = elementMap.get(callback)) !== null && _b !== void 0 ? _b : new Set();
	    elementMap.set(callback, setups);
	    const existed = setups.has(setup);
	    if (wanted) {
	        setups.add(setup);
	    }
	    else {
	        setups.delete(setup);
	    }
	    return existed && wanted;
	}
	function isEventTarget(elements) {
	    return typeof elements.addEventListener === 'function';
	}
	function safeClosest(event, selector) {
	    let target = event.target;
	    if (target instanceof Text) {
	        target = target.parentElement;
	    }
	    if (target instanceof Element && event.currentTarget instanceof Element) {
	        // `.closest()` may match ancestors of `currentTarget` but we only need its children
	        const closest = target.closest(selector);
	        if (closest && event.currentTarget.contains(closest)) {
	            return closest;
	        }
	    }
	}
	// This type isn't exported as a declaration, so it needs to be duplicated above
	function delegate(base, selector, type, callback, options) {
	    // Handle Selector-based usage
	    if (typeof base === 'string') {
	        base = document.querySelectorAll(base);
	    }
	    // Handle Array-like based usage
	    if (!isEventTarget(base)) {
	        const subscriptions = Array.prototype.map.call(base, (element) => delegate(element, selector, type, callback, options));
	        return {
	            destroy() {
	                for (const subscription of subscriptions) {
	                    subscription.destroy();
	                }
	            },
	        };
	    }
	    // `document` should never be the base, it's just an easy way to define "global event listeners"
	    const baseElement = base instanceof Document ? base.documentElement : base;
	    // Handle the regular Element usage
	    const capture = Boolean(typeof options === 'object' ? options.capture : options);
	    const listenerFn = (event) => {
	        const delegateTarget = safeClosest(event, selector);
	        if (delegateTarget) {
	            event.delegateTarget = delegateTarget;
	            callback.call(baseElement, event);
	        }
	    };
	    // Drop unsupported `once` option https://github.com/fregante/delegate-it/pull/28#discussion_r863467939
	    if (typeof options === 'object') {
	        delete options.once;
	    }
	    const setup = JSON.stringify({ selector, type, capture });
	    const isAlreadyListening = editLedger(true, baseElement, callback, setup);
	    const delegateSubscription = {
	        destroy() {
	            baseElement.removeEventListener(type, listenerFn, options);
	            editLedger(false, baseElement, callback, setup);
	        },
	    };
	    if (!isAlreadyListening) {
	        baseElement.addEventListener(type, listenerFn, options);
	    }
	    return delegateSubscription;
	}

	var delegateIt = /*#__PURE__*/Object.freeze({
		__proto__: null,
		'default': delegate
	});

	var require$$1 = /*@__PURE__*/getAugmentedNamespace(delegateIt);

	var Cache$1 = {};

	var helpers = {};

	var classify$1 = {};

	Object.defineProperty(classify$1, "__esModule", {
		value: true
	});
	var classify = function classify(text) {
		var output = text.toString().toLowerCase().replace(/\s+/g, '-') // Replace spaces with -
		.replace(/\//g, '-') // Replace / with -
		.replace(/[^\w\-]+/g, '') // Remove all non-word chars
		.replace(/\-\-+/g, '-') // Replace multiple - with single -
		.replace(/^-+/, '') // Trim - from start of text
		.replace(/-+$/, ''); // Trim - from end of text
		if (output[0] === '/') output = output.splice(1);
		if (output === '') output = 'homepage';
		return output;
	};

	classify$1.default = classify;

	var createHistoryRecord$1 = {};

	Object.defineProperty(createHistoryRecord$1, "__esModule", {
		value: true
	});
	var createHistoryRecord = function createHistoryRecord(url) {
		window.history.pushState({
			url: url || window.location.href.split(window.location.hostname)[1],
			random: Math.random(),
			source: 'swup'
		}, document.title, url || window.location.href.split(window.location.hostname)[1]);
	};

	createHistoryRecord$1.default = createHistoryRecord;

	var getDataFromHtml$1 = {};

	var utils = {};

	Object.defineProperty(utils, "__esModule", {
		value: true
	});
	utils.query = function query(selector) {
		var context = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

		if (typeof selector !== 'string') {
			return selector;
		}

		return context.querySelector(selector);
	};

	utils.queryAll = function queryAll(selector) {
		var context = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document;

		if (typeof selector !== 'string') {
			return selector;
		}

		return Array.prototype.slice.call(context.querySelectorAll(selector));
	};

	utils.escapeCssIdentifier = function escapeCssIdentifier(ident) {
		if (window.CSS && window.CSS.escape) {
			return CSS.escape(ident);
		} else {
			return ident;
		}
	};

	Object.defineProperty(getDataFromHtml$1, "__esModule", {
		value: true
	});

	var _utils$6 = utils;

	var getDataFromHtml = function getDataFromHtml(html, containers) {
		var fakeDom = document.createElement('html');
		fakeDom.innerHTML = html;
		var blocks = [];

		containers.forEach(function (selector) {
			if ((0, _utils$6.query)(selector, fakeDom) == null) {
				console.warn('[swup] Container ' + selector + ' not found on page.');
				return null;
			} else {
				if ((0, _utils$6.queryAll)(selector).length !== (0, _utils$6.queryAll)(selector, fakeDom).length) {
					console.warn('[swup] Mismatched number of containers found on new page.');
				}
				(0, _utils$6.queryAll)(selector).forEach(function (item, index) {
					(0, _utils$6.queryAll)(selector, fakeDom)[index].setAttribute('data-swup', blocks.length);
					blocks.push((0, _utils$6.queryAll)(selector, fakeDom)[index].outerHTML);
				});
			}
		});

		var json = {
			title: (fakeDom.querySelector('title') || {}).innerText,
			pageClass: fakeDom.querySelector('body').className,
			originalContent: html,
			blocks: blocks
		};

		// to prevent memory leaks
		fakeDom.innerHTML = '';
		fakeDom = null;

		return json;
	};

	getDataFromHtml$1.default = getDataFromHtml;

	var fetch$1 = {};

	Object.defineProperty(fetch$1, "__esModule", {
		value: true
	});

	var _extends$6 = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var fetch = function fetch(setOptions) {
		var callback = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

		var defaults = {
			url: window.location.pathname + window.location.search,
			method: 'GET',
			data: null,
			headers: {}
		};

		var options = _extends$6({}, defaults, setOptions);

		var request = new XMLHttpRequest();

		request.onreadystatechange = function () {
			if (request.readyState === 4) {
				if (request.status !== 500) {
					callback(request);
				} else {
					callback(request);
				}
			}
		};

		request.open(options.method, options.url, true);
		Object.keys(options.headers).forEach(function (key) {
			request.setRequestHeader(key, options.headers[key]);
		});
		request.send(options.data);
		return request;
	};

	fetch$1.default = fetch;

	var transitionEnd$1 = {};

	Object.defineProperty(transitionEnd$1, "__esModule", {
		value: true
	});
	var transitionEnd = function transitionEnd() {
		if (window.ontransitionend === undefined && window.onwebkittransitionend !== undefined) {
			return 'webkitTransitionEnd';
		} else {
			return 'transitionend';
		}
	};

	transitionEnd$1.default = transitionEnd;

	var transitionProperty$1 = {};

	Object.defineProperty(transitionProperty$1, "__esModule", {
		value: true
	});
	var transitionProperty = function transitionProperty() {
		if (window.ontransitionend === undefined && window.onwebkittransitionend !== undefined) {
			return 'WebkitTransition';
		} else {
			return 'transition';
		}
	};

	transitionProperty$1.default = transitionProperty;

	var getCurrentUrl$1 = {};

	Object.defineProperty(getCurrentUrl$1, "__esModule", {
		value: true
	});
	var getCurrentUrl = function getCurrentUrl() {
		return window.location.pathname + window.location.search;
	};

	getCurrentUrl$1.default = getCurrentUrl;

	var normalizeUrl$1 = {};

	var Link$1 = {};

	Object.defineProperty(Link$1, "__esModule", {
		value: true
	});

	var _createClass$7 = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck$8(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var Link = function () {
		function Link(elementOrUrl) {
			_classCallCheck$8(this, Link);

			if (elementOrUrl instanceof Element || elementOrUrl instanceof SVGElement) {
				this.link = elementOrUrl;
			} else {
				this.link = document.createElement('a');
				this.link.href = elementOrUrl;
			}
		}

		_createClass$7(Link, [{
			key: 'getPath',
			value: function getPath() {
				var path = this.link.pathname;
				if (path[0] !== '/') {
					path = '/' + path;
				}
				return path;
			}
		}, {
			key: 'getAddress',
			value: function getAddress() {
				var path = this.link.pathname + this.link.search;

				if (this.link.getAttribute('xlink:href')) {
					path = this.link.getAttribute('xlink:href');
				}

				if (path[0] !== '/') {
					path = '/' + path;
				}
				return path;
			}
		}, {
			key: 'getHash',
			value: function getHash() {
				return this.link.hash;
			}
		}]);

		return Link;
	}();

	Link$1.default = Link;

	Object.defineProperty(normalizeUrl$1, "__esModule", {
		value: true
	});

	var _Link$1 = Link$1;

	var _Link2$1 = _interopRequireDefault$5(_Link$1);

	function _interopRequireDefault$5(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	var normalizeUrl = function normalizeUrl(url) {
		return new _Link2$1.default(url).getAddress();
	};

	normalizeUrl$1.default = normalizeUrl;

	var markSwupElements$1 = {};

	Object.defineProperty(markSwupElements$1, "__esModule", {
		value: true
	});

	var _utils$5 = utils;

	var markSwupElements = function markSwupElements(element, containers) {
		var blocks = 0;

		containers.forEach(function (selector) {
			if ((0, _utils$5.query)(selector, element) == null) {
				console.warn('[swup] Container ' + selector + ' not found on page.');
			} else {
				(0, _utils$5.queryAll)(selector).forEach(function (item, index) {
					(0, _utils$5.queryAll)(selector, element)[index].setAttribute('data-swup', blocks);
					blocks++;
				});
			}
		});
	};

	markSwupElements$1.default = markSwupElements;

	var cleanupAnimationClasses$1 = {};

	Object.defineProperty(cleanupAnimationClasses$1, "__esModule", {
		value: true
	});
	var cleanupAnimationClasses = function cleanupAnimationClasses() {
		document.documentElement.className.split(' ').forEach(function (classItem) {
			if (
			// remove "to-{page}" classes
			new RegExp('^to-').test(classItem) ||
			// remove all other classes
			classItem === 'is-changing' || classItem === 'is-rendering' || classItem === 'is-popstate') {
				document.documentElement.classList.remove(classItem);
			}
		});
	};

	cleanupAnimationClasses$1.default = cleanupAnimationClasses;

	Object.defineProperty(helpers, "__esModule", {
	  value: true
	});
	helpers.cleanupAnimationClasses = helpers.Link = helpers.markSwupElements = helpers.normalizeUrl = helpers.getCurrentUrl = helpers.transitionProperty = helpers.transitionEnd = helpers.fetch = helpers.getDataFromHtml = helpers.createHistoryRecord = helpers.classify = undefined;

	var _classify = classify$1;

	var _classify2 = _interopRequireDefault$4(_classify);

	var _createHistoryRecord = createHistoryRecord$1;

	var _createHistoryRecord2 = _interopRequireDefault$4(_createHistoryRecord);

	var _getDataFromHtml = getDataFromHtml$1;

	var _getDataFromHtml2 = _interopRequireDefault$4(_getDataFromHtml);

	var _fetch = fetch$1;

	var _fetch2 = _interopRequireDefault$4(_fetch);

	var _transitionEnd = transitionEnd$1;

	var _transitionEnd2 = _interopRequireDefault$4(_transitionEnd);

	var _transitionProperty = transitionProperty$1;

	var _transitionProperty2 = _interopRequireDefault$4(_transitionProperty);

	var _getCurrentUrl = getCurrentUrl$1;

	var _getCurrentUrl2 = _interopRequireDefault$4(_getCurrentUrl);

	var _normalizeUrl = normalizeUrl$1;

	var _normalizeUrl2 = _interopRequireDefault$4(_normalizeUrl);

	var _markSwupElements = markSwupElements$1;

	var _markSwupElements2 = _interopRequireDefault$4(_markSwupElements);

	var _Link = Link$1;

	var _Link2 = _interopRequireDefault$4(_Link);

	var _cleanupAnimationClasses = cleanupAnimationClasses$1;

	var _cleanupAnimationClasses2 = _interopRequireDefault$4(_cleanupAnimationClasses);

	function _interopRequireDefault$4(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	helpers.classify = _classify2.default;
	helpers.createHistoryRecord = _createHistoryRecord2.default;
	helpers.getDataFromHtml = _getDataFromHtml2.default;
	helpers.fetch = _fetch2.default;
	helpers.transitionEnd = _transitionEnd2.default;
	helpers.transitionProperty = _transitionProperty2.default;
	helpers.getCurrentUrl = _getCurrentUrl2.default;
	helpers.normalizeUrl = _normalizeUrl2.default;
	helpers.markSwupElements = _markSwupElements2.default;
	helpers.Link = _Link2.default;
	helpers.cleanupAnimationClasses = _cleanupAnimationClasses2.default;

	Object.defineProperty(Cache$1, "__esModule", {
		value: true
	});
	Cache$1.Cache = undefined;

	var _createClass$6 = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	var _helpers$7 = helpers;

	function _classCallCheck$7(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var Cache = Cache$1.Cache = function () {
		function Cache() {
			_classCallCheck$7(this, Cache);

			this.pages = {};
			this.last = null;
		}

		_createClass$6(Cache, [{
			key: 'cacheUrl',
			value: function cacheUrl(page) {
				page.url = (0, _helpers$7.normalizeUrl)(page.url);
				if (page.url in this.pages === false) {
					this.pages[page.url] = page;
				}
				this.last = this.pages[page.url];
				this.swup.log('Cache (' + Object.keys(this.pages).length + ')', this.pages);
			}
		}, {
			key: 'getPage',
			value: function getPage(url) {
				url = (0, _helpers$7.normalizeUrl)(url);
				return this.pages[url];
			}
		}, {
			key: 'getCurrentPage',
			value: function getCurrentPage() {
				return this.getPage((0, _helpers$7.getCurrentUrl)());
			}
		}, {
			key: 'exists',
			value: function exists(url) {
				url = (0, _helpers$7.normalizeUrl)(url);
				return url in this.pages;
			}
		}, {
			key: 'empty',
			value: function empty() {
				this.pages = {};
				this.last = null;
				this.swup.log('Cache cleared');
			}
		}, {
			key: 'remove',
			value: function remove(url) {
				delete this.pages[url];
			}
		}]);

		return Cache;
	}();

	Cache$1.default = Cache;

	var loadPage$1 = {};

	Object.defineProperty(loadPage$1, "__esModule", {
		value: true
	});

	var _slicedToArray = function () { function sliceIterator(arr, i) { var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"]) _i["return"](); } finally { if (_d) throw _e; } } return _arr; } return function (arr, i) { if (Array.isArray(arr)) { return arr; } else if (Symbol.iterator in Object(arr)) { return sliceIterator(arr, i); } else { throw new TypeError("Invalid attempt to destructure non-iterable instance"); } }; }();

	var _extends$5 = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _helpers$6 = helpers;

	var loadPage = function loadPage(data, popstate) {
		var _this = this;

		// create array for storing animation promises
		var animationPromises = [],
		    xhrPromise = void 0;
		var animateOut = function animateOut() {
			_this.triggerEvent('animationOutStart');

			// handle classes
			document.documentElement.classList.add('is-changing');
			document.documentElement.classList.add('is-leaving');
			document.documentElement.classList.add('is-animating');
			if (popstate) {
				document.documentElement.classList.add('is-popstate');
			}
			document.documentElement.classList.add('to-' + (0, _helpers$6.classify)(data.url));

			// animation promise stuff
			animationPromises = _this.getAnimationPromises('out');
			Promise.all(animationPromises).then(function () {
				_this.triggerEvent('animationOutDone');
			});

			// create history record if this is not a popstate call
			if (!popstate) {
				// create pop element with or without anchor
				var state = void 0;
				if (_this.scrollToElement != null) {
					state = data.url + _this.scrollToElement;
				} else {
					state = data.url;
				}

				(0, _helpers$6.createHistoryRecord)(state);
			}
		};

		this.triggerEvent('transitionStart', popstate);

		// set transition object
		if (data.customTransition != null) {
			this.updateTransition(window.location.pathname, data.url, data.customTransition);
			document.documentElement.classList.add('to-' + (0, _helpers$6.classify)(data.customTransition));
		} else {
			this.updateTransition(window.location.pathname, data.url);
		}

		// start/skip animation
		if (!popstate || this.options.animateHistoryBrowsing) {
			animateOut();
		} else {
			this.triggerEvent('animationSkipped');
		}

		// start/skip loading of page
		if (this.cache.exists(data.url)) {
			xhrPromise = new Promise(function (resolve) {
				resolve(_this.cache.getPage(data.url));
			});
			this.triggerEvent('pageRetrievedFromCache');
		} else {
			if (!this.preloadPromise || this.preloadPromise.route != data.url) {
				xhrPromise = new Promise(function (resolve, reject) {
					(0, _helpers$6.fetch)(_extends$5({}, data, { headers: _this.options.requestHeaders }), function (response) {
						if (response.status === 500) {
							_this.triggerEvent('serverError');
							reject(data.url);
							return;
						} else {
							// get json data
							var page = _this.getPageData(response);
							if (page != null && page.blocks.length > 0) {
								page.url = data.url;
							} else {
								reject(data.url);
								return;
							}
							// render page
							_this.cache.cacheUrl(page);
							_this.triggerEvent('pageLoaded');
							resolve(page);
						}
					});
				});
			} else {
				xhrPromise = this.preloadPromise;
			}
		}

		// when everything is ready, handle the outcome
		Promise.all([xhrPromise].concat(animationPromises)).then(function (_ref) {
			var _ref2 = _slicedToArray(_ref, 1),
			    pageData = _ref2[0];

			// render page
			_this.renderPage(pageData, popstate);
			_this.preloadPromise = null;
		}).catch(function (errorUrl) {
			// rewrite the skipPopStateHandling function to redirect manually when the history.go is processed
			_this.options.skipPopStateHandling = function () {
				window.location = errorUrl;
				return true;
			};

			// go back to the actual page were still at
			window.history.go(-1);
		});
	};

	loadPage$1.default = loadPage;

	var renderPage$1 = {};

	Object.defineProperty(renderPage$1, "__esModule", {
		value: true
	});

	var _extends$4 = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _helpers$5 = helpers;

	var renderPage = function renderPage(page, popstate) {
		var _this = this;

		document.documentElement.classList.remove('is-leaving');

		var isCurrentPage = this.getCurrentUrl() === page.url;
		if (!isCurrentPage) return;

		// replace state in case the url was redirected
		var url = new _helpers$5.Link(page.responseURL).getPath();
		if (window.location.pathname !== url) {
			window.history.replaceState({
				url: url,
				random: Math.random(),
				source: 'swup'
			}, document.title, url);

			// save new record for redirected url
			this.cache.cacheUrl(_extends$4({}, page, { url: url }));
		}

		// only add for non-popstate transitions
		if (!popstate || this.options.animateHistoryBrowsing) {
			document.documentElement.classList.add('is-rendering');
		}

		this.triggerEvent('willReplaceContent', popstate);
		// replace blocks
		for (var i = 0; i < page.blocks.length; i++) {
			document.body.querySelector('[data-swup="' + i + '"]').outerHTML = page.blocks[i];
		}
		// set title
		document.title = page.title;
		this.triggerEvent('contentReplaced', popstate);
		this.triggerEvent('pageView', popstate);

		// empty cache if it's disabled (because pages could be preloaded and stuff)
		if (!this.options.cache) {
			this.cache.empty();
		}

		// start animation IN
		setTimeout(function () {
			if (!popstate || _this.options.animateHistoryBrowsing) {
				_this.triggerEvent('animationInStart');
				document.documentElement.classList.remove('is-animating');
			}
		}, 10);

		// handle end of animation
		if (!popstate || this.options.animateHistoryBrowsing) {
			var animationPromises = this.getAnimationPromises('in');
			Promise.all(animationPromises).then(function () {
				_this.triggerEvent('animationInDone');
				_this.triggerEvent('transitionEnd', popstate);
				_this.cleanupAnimationClasses();
			});
		} else {
			this.triggerEvent('transitionEnd', popstate);
		}

		// reset scroll-to element
		this.scrollToElement = null;
	};

	renderPage$1.default = renderPage;

	var triggerEvent$1 = {};

	Object.defineProperty(triggerEvent$1, "__esModule", {
		value: true
	});
	var triggerEvent = function triggerEvent(eventName, originalEvent) {
		// call saved handlers with "on" method and pass originalEvent object if available
		this._handlers[eventName].forEach(function (handler) {
			try {
				handler(originalEvent);
			} catch (error) {
				console.error(error);
			}
		});

		// trigger event on document with prefix "swup:"
		var event = new CustomEvent('swup:' + eventName, { detail: eventName });
		document.dispatchEvent(event);
	};

	triggerEvent$1.default = triggerEvent;

	var on$1 = {};

	Object.defineProperty(on$1, "__esModule", {
		value: true
	});
	var on = function on(event, handler) {
		if (this._handlers[event]) {
			this._handlers[event].push(handler);
		} else {
			console.warn("Unsupported event " + event + ".");
		}
	};

	on$1.default = on;

	var off$1 = {};

	Object.defineProperty(off$1, "__esModule", {
		value: true
	});
	var off = function off(event, handler) {
		var _this = this;

		if (event != null) {
			if (handler != null) {
				if (this._handlers[event] && this._handlers[event].filter(function (savedHandler) {
					return savedHandler === handler;
				}).length) {
					var toRemove = this._handlers[event].filter(function (savedHandler) {
						return savedHandler === handler;
					})[0];
					var index = this._handlers[event].indexOf(toRemove);
					if (index > -1) {
						this._handlers[event].splice(index, 1);
					}
				} else {
					console.warn("Handler for event '" + event + "' no found.");
				}
			} else {
				this._handlers[event] = [];
			}
		} else {
			Object.keys(this._handlers).forEach(function (keys) {
				_this._handlers[keys] = [];
			});
		}
	};

	off$1.default = off;

	var updateTransition$1 = {};

	Object.defineProperty(updateTransition$1, "__esModule", {
		value: true
	});
	var updateTransition = function updateTransition(from, to, custom) {
		// transition routes
		this.transition = {
			from: from,
			to: to,
			custom: custom
		};
	};

	updateTransition$1.default = updateTransition;

	var getAnchorElement$1 = {};

	Object.defineProperty(getAnchorElement$1, "__esModule", {
		value: true
	});

	var _utils$4 = utils;

	var getAnchorElement = function getAnchorElement(hash) {
		if (!hash) {
			return null;
		}

		if (hash.charAt(0) === '#') {
			hash = hash.substring(1);
		}

		hash = decodeURIComponent(hash);
		hash = (0, _utils$4.escapeCssIdentifier)(hash);

		// https://html.spec.whatwg.org/#find-a-potential-indicated-element
		return (0, _utils$4.query)('#' + hash) || (0, _utils$4.query)('a[name=\'' + hash + '\']');
	};

	getAnchorElement$1.default = getAnchorElement;

	var getAnimationPromises$1 = {};

	Object.defineProperty(getAnimationPromises$1, "__esModule", {
		value: true
	});

	var _utils$3 = utils;

	var _helpers$4 = helpers;

	var getAnimationPromises = function getAnimationPromises() {
		var selector = this.options.animationSelector;
		var durationProperty = (0, _helpers$4.transitionProperty)() + 'Duration';
		var promises = [];
		var animatedElements = (0, _utils$3.queryAll)(selector, document.body);

		if (!animatedElements.length) {
			console.warn('[swup] No animated elements found by selector ' + selector);
			return [Promise.resolve()];
		}

		animatedElements.forEach(function (element) {
			var transitionDuration = window.getComputedStyle(element)[durationProperty];
			// Resolve immediately if no transition defined
			if (!transitionDuration || transitionDuration == '0s') {
				console.warn('[swup] No CSS transition duration defined for element of selector ' + selector);
				promises.push(Promise.resolve());
				return;
			}
			var promise = new Promise(function (resolve) {
				element.addEventListener((0, _helpers$4.transitionEnd)(), function (event) {
					if (element == event.target) {
						resolve();
					}
				});
			});
			promises.push(promise);
		});

		return promises;
	};

	getAnimationPromises$1.default = getAnimationPromises;

	var getPageData$1 = {};

	Object.defineProperty(getPageData$1, "__esModule", {
		value: true
	});

	var _helpers$3 = helpers;

	var getPageData = function getPageData(request) {
		// this method can be replaced in case other content than html is expected to be received from server
		// this function should always return {title, pageClass, originalContent, blocks, responseURL}
		// in case page has invalid structure - return null
		var html = request.responseText;
		var pageObject = (0, _helpers$3.getDataFromHtml)(html, this.options.containers);

		if (pageObject) {
			pageObject.responseURL = request.responseURL ? request.responseURL : window.location.href;
		} else {
			console.warn('[swup] Received page is invalid.');
			return null;
		}

		return pageObject;
	};

	getPageData$1.default = getPageData;

	var plugins = {};

	Object.defineProperty(plugins, "__esModule", {
		value: true
	});
	plugins.use = function use(plugin) {
		if (!plugin.isSwupPlugin) {
			console.warn('Not swup plugin instance ' + plugin + '.');
			return;
		}

		this.plugins.push(plugin);
		plugin.swup = this;
		if (typeof plugin._beforeMount === 'function') {
			plugin._beforeMount();
		}
		plugin.mount();

		return this.plugins;
	};

	plugins.unuse = function unuse(plugin) {
		var pluginReference = void 0;

		if (typeof plugin === 'string') {
			pluginReference = this.plugins.find(function (p) {
				return plugin === p.name;
			});
		} else {
			pluginReference = plugin;
		}

		if (!pluginReference) {
			console.warn('No such plugin.');
			return;
		}

		pluginReference.unmount();

		if (typeof pluginReference._afterUnmount === 'function') {
			pluginReference._afterUnmount();
		}

		var index = this.plugins.indexOf(pluginReference);
		this.plugins.splice(index, 1);

		return this.plugins;
	};

	plugins.findPlugin = function findPlugin(pluginName) {
		return this.plugins.find(function (p) {
			return pluginName === p.name;
		});
	};

	Object.defineProperty(lib$6, "__esModule", {
		value: true
	});

	var _extends$3 = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _createClass$5 = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	// modules


	var _delegateIt$1 = require$$1;

	var _delegateIt2$1 = _interopRequireDefault$3(_delegateIt$1);

	var _Cache = Cache$1;

	var _Cache2 = _interopRequireDefault$3(_Cache);

	var _loadPage = loadPage$1;

	var _loadPage2 = _interopRequireDefault$3(_loadPage);

	var _renderPage = renderPage$1;

	var _renderPage2 = _interopRequireDefault$3(_renderPage);

	var _triggerEvent = triggerEvent$1;

	var _triggerEvent2 = _interopRequireDefault$3(_triggerEvent);

	var _on = on$1;

	var _on2 = _interopRequireDefault$3(_on);

	var _off = off$1;

	var _off2 = _interopRequireDefault$3(_off);

	var _updateTransition = updateTransition$1;

	var _updateTransition2 = _interopRequireDefault$3(_updateTransition);

	var _getAnchorElement = getAnchorElement$1;

	var _getAnchorElement2 = _interopRequireDefault$3(_getAnchorElement);

	var _getAnimationPromises = getAnimationPromises$1;

	var _getAnimationPromises2 = _interopRequireDefault$3(_getAnimationPromises);

	var _getPageData = getPageData$1;

	var _getPageData2 = _interopRequireDefault$3(_getPageData);

	var _plugins = plugins;

	var _utils$2 = utils;

	var _helpers$2 = helpers;

	function _interopRequireDefault$3(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _classCallCheck$6(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var Swup = function () {
		function Swup(setOptions) {
			_classCallCheck$6(this, Swup);

			// default options
			var defaults = {
				animateHistoryBrowsing: false,
				animationSelector: '[class*="transition-"]',
				linkSelector: 'a[href^="' + window.location.origin + '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup])',
				cache: true,
				containers: ['#swup'],
				requestHeaders: {
					'X-Requested-With': 'swup',
					Accept: 'text/html, application/xhtml+xml'
				},
				plugins: [],
				skipPopStateHandling: function skipPopStateHandling(event) {
					return !(event.state && event.state.source === 'swup');
				}
			};

			// merge options
			var options = _extends$3({}, defaults, setOptions);

			// handler arrays
			this._handlers = {
				animationInDone: [],
				animationInStart: [],
				animationOutDone: [],
				animationOutStart: [],
				animationSkipped: [],
				clickLink: [],
				contentReplaced: [],
				disabled: [],
				enabled: [],
				openPageInNewTab: [],
				pageLoaded: [],
				pageRetrievedFromCache: [],
				pageView: [],
				popState: [],
				samePage: [],
				samePageWithHash: [],
				serverError: [],
				transitionStart: [],
				transitionEnd: [],
				willReplaceContent: []
			};

			// variable for anchor to scroll to after render
			this.scrollToElement = null;
			// variable for promise used for preload, so no new loading of the same page starts while page is loading
			this.preloadPromise = null;
			// variable for save options
			this.options = options;
			// variable for plugins array
			this.plugins = [];
			// variable for current transition object
			this.transition = {};
			// variable for keeping event listeners from "delegate"
			this.delegatedListeners = {};
			// so we are able to remove the listener
			this.boundPopStateHandler = this.popStateHandler.bind(this);

			// make modules accessible in instance
			this.cache = new _Cache2.default();
			this.cache.swup = this;
			this.loadPage = _loadPage2.default;
			this.renderPage = _renderPage2.default;
			this.triggerEvent = _triggerEvent2.default;
			this.on = _on2.default;
			this.off = _off2.default;
			this.updateTransition = _updateTransition2.default;
			this.getAnimationPromises = _getAnimationPromises2.default;
			this.getPageData = _getPageData2.default;
			this.getAnchorElement = _getAnchorElement2.default;
			this.log = function () {}; // here so it can be used by plugins
			this.use = _plugins.use;
			this.unuse = _plugins.unuse;
			this.findPlugin = _plugins.findPlugin;
			this.getCurrentUrl = _helpers$2.getCurrentUrl;
			this.cleanupAnimationClasses = _helpers$2.cleanupAnimationClasses;

			// enable swup
			this.enable();
		}

		_createClass$5(Swup, [{
			key: 'enable',
			value: function enable() {
				var _this = this;

				// check for Promise support
				if (typeof Promise === 'undefined') {
					console.warn('Promise is not supported');
					return;
				}

				// add event listeners
				this.delegatedListeners.click = (0, _delegateIt2$1.default)(document, this.options.linkSelector, 'click', this.linkClickHandler.bind(this));
				window.addEventListener('popstate', this.boundPopStateHandler);

				// initial save to cache
				if (this.options.cache) ;
				// disabled to avoid caching modified dom state
				// https://github.com/swup/swup/issues/475
				// logic moved to preload plugin


				// mark swup blocks in html
				(0, _helpers$2.markSwupElements)(document.documentElement, this.options.containers);

				// mount plugins
				this.options.plugins.forEach(function (plugin) {
					_this.use(plugin);
				});

				// modify initial history record
				window.history.replaceState(Object.assign({}, window.history.state, {
					url: window.location.href,
					random: Math.random(),
					source: 'swup'
				}), document.title, window.location.href);

				// trigger enabled event
				this.triggerEvent('enabled');

				// add swup-enabled class to html tag
				document.documentElement.classList.add('swup-enabled');

				// trigger page view event
				this.triggerEvent('pageView');
			}
		}, {
			key: 'destroy',
			value: function destroy() {
				var _this2 = this;

				// remove delegated listeners
				this.delegatedListeners.click.destroy();

				// remove popstate listener
				window.removeEventListener('popstate', this.boundPopStateHandler);

				// empty cache
				this.cache.empty();

				// unmount plugins
				this.options.plugins.forEach(function (plugin) {
					_this2.unuse(plugin);
				});

				// remove swup data atributes from blocks
				(0, _utils$2.queryAll)('[data-swup]').forEach(function (element) {
					element.removeAttribute('data-swup');
				});

				// remove handlers
				this.off();

				// trigger disable event
				this.triggerEvent('disabled');

				// remove swup-enabled class from html tag
				document.documentElement.classList.remove('swup-enabled');
			}
		}, {
			key: 'linkClickHandler',
			value: function linkClickHandler(event) {
				// no control key pressed
				if (!event.metaKey && !event.ctrlKey && !event.shiftKey && !event.altKey) {
					// index of pressed button needs to be checked because Firefox triggers click on all mouse buttons
					if (event.button === 0) {
						this.triggerEvent('clickLink', event);
						event.preventDefault();
						var link = new _helpers$2.Link(event.delegateTarget);
						if (link.getAddress() == (0, _helpers$2.getCurrentUrl)() || link.getAddress() == '') {
							// link to the same URL
							if (link.getHash() != '') {
								// link to the same URL with hash
								this.triggerEvent('samePageWithHash', event);
								var element = (0, _getAnchorElement2.default)(link.getHash());
								if (element != null) {
									history.replaceState({
										url: link.getAddress() + link.getHash(),
										random: Math.random(),
										source: 'swup'
									}, document.title, link.getAddress() + link.getHash());
								} else {
									// referenced element not found
									console.warn('Element for offset not found (' + link.getHash() + ')');
								}
							} else {
								// link to the same URL without hash
								this.triggerEvent('samePage', event);
							}
						} else {
							// link to different url
							if (link.getHash() != '') {
								this.scrollToElement = link.getHash();
							}

							// get custom transition from data
							var customTransition = event.delegateTarget.getAttribute('data-swup-transition');

							// load page
							this.loadPage({ url: link.getAddress(), customTransition: customTransition }, false);
						}
					}
				} else {
					// open in new tab (do nothing)
					this.triggerEvent('openPageInNewTab', event);
				}
			}
		}, {
			key: 'popStateHandler',
			value: function popStateHandler(event) {
				if (this.options.skipPopStateHandling(event)) return;
				var link = new _helpers$2.Link(event.state ? event.state.url : window.location.pathname);
				if (link.getHash() !== '') {
					this.scrollToElement = link.getHash();
				} else {
					event.preventDefault();
				}
				this.triggerEvent('popState', event);

				if (!this.options.animateHistoryBrowsing) {
					document.documentElement.classList.remove('is-animating');
					(0, _helpers$2.cleanupAnimationClasses)();
				}

				this.loadPage({ url: link.getAddress() }, event);
			}
		}]);

		return Swup;
	}();

	var _default$3 = lib$6.default = Swup;

	var lib$5 = {};

	var lib$4 = {};

	Object.defineProperty(lib$4, "__esModule", {
	    value: true
	});

	var _createClass$4 = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck$5(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var Plugin = function () {
	    function Plugin() {
	        _classCallCheck$5(this, Plugin);

	        this.isSwupPlugin = true;
	    }

	    _createClass$4(Plugin, [{
	        key: "mount",
	        value: function mount() {
	            // this is mount method rewritten by class extending
	            // and is executed when swup is enabled with plugin
	        }
	    }, {
	        key: "unmount",
	        value: function unmount() {
	            // this is unmount method rewritten by class extending
	            // and is executed when swup with plugin is disabled
	        }
	    }, {
	        key: "_beforeMount",
	        value: function _beforeMount() {
	            // here for any future hidden auto init
	        }
	    }, {
	        key: "_afterUnmount",
	        value: function _afterUnmount() {}
	        // here for any future hidden auto-cleanup


	        // this is here so we can tell if plugin was created by extending this class

	    }]);

	    return Plugin;
	}();

	lib$4.default = Plugin;

	var lib$3 = {};

	Object.defineProperty(lib$3, "__esModule", {
	    value: true
	});

	var _extends$2 = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	function _classCallCheck$4(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var Scrl = function Scrl(options) {
	    var _this = this;

	    _classCallCheck$4(this, Scrl);

	    this._raf = null;
	    this._positionY = 0;
	    this._velocityY = 0;
	    this._targetPositionY = 0;
	    this._targetPositionYWithOffset = 0;
	    this._direction = 0;

	    this.scrollTo = function (offset) {
	        if (offset && offset.nodeType) {
	            // the offset is element
	            _this._targetPositionY = Math.round(offset.getBoundingClientRect().top + window.pageYOffset);
	        } else if (parseInt(_this._targetPositionY) === _this._targetPositionY) {
	            // the offset is a number
	            _this._targetPositionY = Math.round(offset);
	        } else {
	            console.error('Argument must be a number or an element.');
	            return;
	        }

	        // don't animate beyond the document height
	        if (_this._targetPositionY > document.documentElement.scrollHeight - window.innerHeight) {
	            _this._targetPositionY = document.documentElement.scrollHeight - window.innerHeight;
	        }

	        // calculated required values
	        _this._positionY = document.body.scrollTop || document.documentElement.scrollTop;
	        _this._direction = _this._positionY > _this._targetPositionY ? -1 : 1;
	        _this._targetPositionYWithOffset = _this._targetPositionY + _this._direction;
	        _this._velocityY = 0;

	        if (_this._positionY !== _this._targetPositionY) {
	            // start animation
	            _this.options.onStart();
	            _this._animate();
	        } else {
	            // page is already at the position
	            _this.options.onAlreadyAtPositions();
	        }
	    };

	    this._animate = function () {
	        _this._update();
	        _this._render();

	        if (_this._direction === 1 && _this._targetPositionY > _this._positionY || _this._direction === -1 && _this._targetPositionY < _this._positionY) {
	            // calculate next position
	            _this._raf = requestAnimationFrame(_this._animate);
	            _this.options.onTick();
	        } else {
	            // finish and set position to the final position
	            _this._positionY = _this._targetPositionY;
	            _this._render();
	            _this._raf = null;
	            _this.options.onTick();
	            _this.options.onEnd();
	            // this.triggerEvent('scrollDone')
	        }
	    };

	    this._update = function () {
	        var distance = _this._targetPositionYWithOffset - _this._positionY;
	        var attraction = distance * _this.options.acceleration;

	        _this._velocityY += attraction;

	        _this._velocityY *= _this.options.friction;
	        _this._positionY += _this._velocityY;

	        return Math.abs(distance);
	    };

	    this._render = function () {
	        window.scrollTo(0, _this._positionY);
	    };

	    // default options
	    var defaults = {
	        onAlreadyAtPositions: function onAlreadyAtPositions() {},
	        onCancel: function onCancel() {},
	        onEnd: function onEnd() {},
	        onStart: function onStart() {},
	        onTick: function onTick() {},
	        friction: .7, // 1 - .3
	        acceleration: .04

	        // merge options
	    };this.options = _extends$2({}, defaults, options);

	    // set reverse friction
	    if (options && options.friction) {
	        this.options.friction = 1 - options.friction;
	    }

	    // register listener for cancel on wheel event
	    window.addEventListener('mousewheel', function (event) {
	        if (_this._raf) {
	            _this.options.onCancel();
	            cancelAnimationFrame(_this._raf);
	            _this._raf = null;
	        }
	    }, {
	        passive: true
	    });
	};

	lib$3.default = Scrl;

	Object.defineProperty(lib$5, "__esModule", {
		value: true
	});

	var _extends$1 = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _createClass$3 = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	var _plugin$2 = lib$4;

	var _plugin2$2 = _interopRequireDefault$2(_plugin$2);

	var _scrl = lib$3;

	var _scrl2 = _interopRequireDefault$2(_scrl);

	var _helpers$1 = helpers;

	var _utils$1 = utils;

	function _interopRequireDefault$2(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _classCallCheck$3(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	function _possibleConstructorReturn$2(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

	function _inherits$2(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

	/**
	 * Class representing a Scroll Plugin.
	 * @extends Plugin
	 */
	var ScrollPlugin = function (_Plugin) {
		_inherits$2(ScrollPlugin, _Plugin);

		/**
	  * Constructor
	  * @param {?object} options the plugin options
	  */
		function ScrollPlugin(options) {
			_classCallCheck$3(this, ScrollPlugin);

			var _this = _possibleConstructorReturn$2(this, (ScrollPlugin.__proto__ || Object.getPrototypeOf(ScrollPlugin)).call(this));

			_this.name = 'ScrollPlugin';

			_this.getAnchorElement = function () {
				var hash = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '';

				// Look for a custom function provided via the plugin options
				if (typeof _this.options.getAnchorElement === 'function') {
					return _this.options.getAnchorElement(hash);
				}
				// Look for a the built-in function in swup, added in swup 2.0.16
				if (typeof _this.swup.getAnchorElement === 'function') {
					return _this.swup.getAnchorElement(hash);
				}
				// Finally, return a native browser query
				return document.querySelector(hash);
			};

			_this.getOffset = function () {
				var element = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

				// If options.offset is a function, apply and return it
				if (typeof _this.options.offset === 'function') {
					return parseInt(_this.options.offset(element), 10);
				}
				// Otherwise, return the sanitized offset
				return parseInt(_this.options.offset, 10);
			};

			_this.onSamePage = function () {
				_this.swup.scrollTo(0, _this.shouldAnimate('samePage'));
			};

			_this.onSamePageWithHash = function (event) {
				var link = event.delegateTarget;
				_this.maybeScrollToAnchor(link.hash, 'samePageWithHash');
			};

			_this.onTransitionStart = function (popstate) {
				if (_this.options.doScrollingRightAway && !_this.swup.scrollToElement) {
					_this.doScrollingBetweenPages(popstate);
				}
			};

			_this.onContentReplaced = function (popstate) {
				if (!_this.options.doScrollingRightAway || _this.swup.scrollToElement) {
					_this.doScrollingBetweenPages(popstate);
				}

				_this.restoreScrollContainers(popstate);
			};

			_this.doScrollingBetweenPages = function (popstate) {
				var swup = _this.swup;

				// Bail early on popstate and inactive `animateHistoryBrowsing`
				if (popstate && !swup.options.animateHistoryBrowsing) {
					return;
				}

				// Try scrolling to a given anchor
				if (_this.maybeScrollToAnchor(swup.scrollToElement, 'betweenPages')) {
					swup.scrollToElement = null;
					return;
				}

				// Finally, scroll to either the stored scroll position or to the very top of the page
				var scrollPositions = _this.getStoredScrollPositions((0, _helpers$1.getCurrentUrl)()) || {};
				var top = scrollPositions.window && scrollPositions.window.top || 0;
				// Give possible JavaScript time to execute before scrolling
				requestAnimationFrame(function () {
					return swup.scrollTo(top, _this.shouldAnimate('betweenPages'));
				});
			};

			_this.onWillReplaceContent = function () {
				_this.storeScrollPositions(_this.previousUrl);
				_this.previousUrl = (0, _helpers$1.getCurrentUrl)();
			};

			_this.onClickLink = function (event) {
				_this.maybeResetScrollPositions(event.delegateTarget);
			};

			var defaultOptions = {
				doScrollingRightAway: false,
				animateScroll: {
					betweenPages: true,
					samePageWithHash: true,
					samePage: true
				},
				scrollFriction: 0.3,
				scrollAcceleration: 0.04,
				getAnchorElement: null,
				offset: 0,
				scrollContainers: '[data-swup-scroll-container]',
				shouldResetScrollPosition: function shouldResetScrollPosition(htmlAnchorElement) {
					return true;
				}
			};

			_this.options = _extends$1({}, defaultOptions, options);

			// This object will hold all scroll positions
			_this.scrollPositionsStore = {};
			// this URL helps with storing the current scroll positions on `willReplaceContent`
			_this.previousUrl = (0, _helpers$1.getCurrentUrl)();
			return _this;
		}

		/**
	  * Runs if the plugin is mounted
	  */


		_createClass$3(ScrollPlugin, [{
			key: 'mount',
			value: function mount() {
				var _this2 = this;

				var swup = this.swup;

				// add empty handlers array for scroll events
				swup._handlers.scrollDone = [];
				swup._handlers.scrollStart = [];

				// Initialize Scrl for smooth animations
				this.scrl = new _scrl2.default({
					onStart: function onStart() {
						return swup.triggerEvent('scrollStart');
					},
					onEnd: function onEnd() {
						return swup.triggerEvent('scrollDone');
					},
					onCancel: function onCancel() {
						return swup.triggerEvent('scrollDone');
					},
					friction: this.options.scrollFriction,
					acceleration: this.options.scrollAcceleration
				});

				// set scrollTo method of swup and animate based on current animateScroll option
				swup.scrollTo = function (offset) {
					var animate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

					if (animate) {
						_this2.scrl.scrollTo(offset);
					} else {
						swup.triggerEvent('scrollStart');
						window.scrollTo(0, offset);
						swup.triggerEvent('scrollDone');
					}
				};

				// disable browser scroll control on popstates when
				// animateHistoryBrowsing option is enabled in swup.
				// Cache the previous setting to be able to properly restore it on unmount
				this.previousScrollRestoration = window.history.scrollRestoration;
				if (swup.options.animateHistoryBrowsing) {
					window.history.scrollRestoration = 'manual';
				}

				// scroll to the top of the page
				swup.on('samePage', this.onSamePage);

				// scroll to referenced element on the same page
				swup.on('samePageWithHash', this.onSamePageWithHash);

				// scroll to the referenced element
				swup.on('transitionStart', this.onTransitionStart);

				// scroll to the referenced element when it's in the page (after render)
				swup.on('contentReplaced', this.onContentReplaced);

				swup.on('willReplaceContent', this.onWillReplaceContent);
				swup.on('clickLink', this.onClickLink);
			}

			/**
	   * Runs when the plugin is unmounted
	   */

		}, {
			key: 'unmount',
			value: function unmount() {
				var swup = this.swup;
				swup.scrollTo = null;

				delete this.scrl;
				this.scrl = null;

				swup.off('samePage', this.onSamePage);
				swup.off('samePageWithHash', this.onSamePageWithHash);
				swup.off('transitionStart', this.onTransitionStart);
				swup.off('contentReplaced', this.onContentReplaced);
				swup.off('willReplaceContent', this.onWillReplaceContent);
				swup.off('clickLink', this.onClickLink);

				swup._handlers.scrollDone = null;
				swup._handlers.scrollStart = null;

				window.history.scrollRestoration = this.previousScrollRestoration;
			}

			/**
	   * Detects if a scroll should be animated, based on context
	   * @param {string} context
	   * @returns {boolean}
	   */

		}, {
			key: 'shouldAnimate',
			value: function shouldAnimate(context) {
				if (typeof this.options.animateScroll === 'boolean') {
					return this.options.animateScroll;
				}
				return this.options.animateScroll[context];
			}

			/**
	   * Get an element based on anchor
	   * @param {string} hash
	   * @returns {mixed}
	   */


			/**
	   * Get the offset for a scroll
	   * @param {(HtmlELement|null)} element
	   * @returns {number}
	   */


			/**
	   * Handles `samePage`
	   */


			/**
	   * Handles `onSamePageWithHash`
	   * @param {PointerEvent} event
	   */

		}, {
			key: 'maybeScrollToAnchor',


			/**
	   * Attempts to scroll to an anchor
	   * @param {string} hash
	   * @param {string} context
	   * @returns {boolean}
	   */
			value: function maybeScrollToAnchor(hash, context) {
				// Bail early if the hash is null
				if (hash == null) {
					return false;
				}
				var element = this.getAnchorElement(hash);
				if (!element) {
					console.warn('Element ' + hash + ' not found');
					return false;
				}
				if (!(element instanceof Element)) {
					console.warn('Element ' + hash + ' is not a DOM node');
					return false;
				}
				var top = element.getBoundingClientRect().top + window.pageYOffset - this.getOffset(element);
				this.swup.scrollTo(top, this.shouldAnimate(context));
				return true;
			}

			/**
	   * Handles `transitionStart`
	   * @param {PopStateEvent} popstate
	   */


			/**
	   * Handles `contentReplaced`
	   * @param {PopStateEvent} popstate
	   */


			/**
	   * Scrolls the window, based on context
	   * @param {(PopStateEvent|boolean)} popstate
	   * @returns {void}
	   */


			/**
	   * Stores the current scroll positions for the URL we just came from
	   */


			/**
	   * Handles `clickLink`
	   * @param {PointerEvent}
	   * @returns {void}
	   */

		}, {
			key: 'maybeResetScrollPositions',


			/**
	   * Deletes the scroll positions for the URL a link is pointing to,
	   * if shouldResetScrollPosition evaluates to true
	   * @param {HTMLAnchorElement} htmlAnchorElement
	   * @returns {void}
	   */
			value: function maybeResetScrollPositions(htmlAnchorElement) {
				if (!this.options.shouldResetScrollPosition(htmlAnchorElement)) {
					return;
				}
				var url = new _helpers$1.Link(htmlAnchorElement).getAddress();
				this.resetScrollPositions(url);
			}

			/**
	   * Stores the scroll positions for the current URL
	   * @param {string} url
	   * @returns {void}
	   */

		}, {
			key: 'storeScrollPositions',
			value: function storeScrollPositions(url) {
				// retrieve the current scroll position for all containers
				var containers = (0, _utils$1.queryAll)(this.options.scrollContainers).map(function (el) {
					return {
						top: el.scrollTop,
						left: el.scrollLeft
					};
				});

				// construct the final object entry, with the window scroll positions added
				this.scrollPositionsStore[url] = {
					window: { top: window.scrollY, left: window.scrollX },
					containers: containers
				};
			}

			/**
	   * Resets stored scroll positions for a given URL
	   * @param {string} url
	   */

		}, {
			key: 'resetScrollPositions',
			value: function resetScrollPositions(url) {
				delete this.scrollPositionsStore[url];
				this.scrollPositionsStore[url] = null;
			}

			/**
	   * Get the stored scroll positions for a given URL from the cache
	   * @returns {(object|null)}
	   */

		}, {
			key: 'getStoredScrollPositions',
			value: function getStoredScrollPositions(url) {
				return this.scrollPositionsStore[url];
			}

			/**
	   * Restore the scroll positions for all matching scrollContainers
	   * @returns void
	   */

		}, {
			key: 'restoreScrollContainers',
			value: function restoreScrollContainers(popstate) {
				// get the stored scroll positions from the cache
				var scrollPositions = this.getStoredScrollPositions((0, _helpers$1.getCurrentUrl)()) || {};
				if (scrollPositions.containers == null) {
					return;
				}

				// cycle through all containers on the current page and restore their scroll positions, if appropriate
				(0, _utils$1.queryAll)(this.options.scrollContainers).forEach(function (el, index) {
					var scrollPosition = scrollPositions.containers[index];
					if (scrollPosition == null) return;
					el.scrollTop = scrollPosition.top;
					el.scrollLeft = scrollPosition.left;
				});
			}
		}]);

		return ScrollPlugin;
	}(_plugin2$2.default);

	var _default$2 = lib$5.default = ScrollPlugin;

	var lib$2 = {exports: {}};

	(function (module, exports) {
	(function webpackUniversalModuleDefinition(root, factory) {
		module.exports = factory();
	})(window, function() {
	return /******/ (function(modules) { // webpackBootstrap
	/******/ 	// The module cache
	/******/ 	var installedModules = {};
	/******/
	/******/ 	// The require function
	/******/ 	function __webpack_require__(moduleId) {
	/******/
	/******/ 		// Check if module is in cache
	/******/ 		if(installedModules[moduleId]) {
	/******/ 			return installedModules[moduleId].exports;
	/******/ 		}
	/******/ 		// Create a new module (and put it into the cache)
	/******/ 		var module = installedModules[moduleId] = {
	/******/ 			i: moduleId,
	/******/ 			l: false,
	/******/ 			exports: {}
	/******/ 		};
	/******/
	/******/ 		// Execute the module function
	/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
	/******/
	/******/ 		// Flag the module as loaded
	/******/ 		module.l = true;
	/******/
	/******/ 		// Return the exports of the module
	/******/ 		return module.exports;
	/******/ 	}
	/******/
	/******/
	/******/ 	// expose the modules object (__webpack_modules__)
	/******/ 	__webpack_require__.m = modules;
	/******/
	/******/ 	// expose the module cache
	/******/ 	__webpack_require__.c = installedModules;
	/******/
	/******/ 	// define getter function for harmony exports
	/******/ 	__webpack_require__.d = function(exports, name, getter) {
	/******/ 		if(!__webpack_require__.o(exports, name)) {
	/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
	/******/ 		}
	/******/ 	};
	/******/
	/******/ 	// define __esModule on exports
	/******/ 	__webpack_require__.r = function(exports) {
	/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
	/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
	/******/ 		}
	/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
	/******/ 	};
	/******/
	/******/ 	// create a fake namespace object
	/******/ 	// mode & 1: value is a module id, require it
	/******/ 	// mode & 2: merge all properties of value into the ns
	/******/ 	// mode & 4: return value when already ns object
	/******/ 	// mode & 8|1: behave like require
	/******/ 	__webpack_require__.t = function(value, mode) {
	/******/ 		if(mode & 1) value = __webpack_require__(value);
	/******/ 		if(mode & 8) return value;
	/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
	/******/ 		var ns = Object.create(null);
	/******/ 		__webpack_require__.r(ns);
	/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
	/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
	/******/ 		return ns;
	/******/ 	};
	/******/
	/******/ 	// getDefaultExport function for compatibility with non-harmony modules
	/******/ 	__webpack_require__.n = function(module) {
	/******/ 		var getter = module && module.__esModule ?
	/******/ 			function getDefault() { return module['default']; } :
	/******/ 			function getModuleExports() { return module; };
	/******/ 		__webpack_require__.d(getter, 'a', getter);
	/******/ 		return getter;
	/******/ 	};
	/******/
	/******/ 	// Object.prototype.hasOwnProperty.call
	/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
	/******/
	/******/ 	// __webpack_public_path__
	/******/ 	__webpack_require__.p = "";
	/******/
	/******/
	/******/ 	// Load entry module and return exports
	/******/ 	return __webpack_require__(__webpack_require__.s = 0);
	/******/ })
	/************************************************************************/
	/******/ ([
	/* 0 */
	/***/ (function(module, exports, __webpack_require__) {


	var _index = __webpack_require__(1);

	var _index2 = _interopRequireDefault(_index);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	module.exports = _index2.default; // this is here for webpack to expose SwupTheme as window.SwupTheme

	/***/ }),
	/* 1 */
	/***/ (function(module, exports, __webpack_require__) {


	Object.defineProperty(exports, "__esModule", {
		value: true
	});

	var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	var _theme = __webpack_require__(2);

	var _theme2 = _interopRequireDefault(_theme);

	var _index = __webpack_require__(3);

	var _index2 = _interopRequireDefault(_index);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

	function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

	var FadeTheme = function (_Theme) {
		_inherits(FadeTheme, _Theme);

		function FadeTheme(options) {
			_classCallCheck(this, FadeTheme);

			var _this = _possibleConstructorReturn(this, (FadeTheme.__proto__ || Object.getPrototypeOf(FadeTheme)).call(this));

			_this.name = 'FadeTheme';


			var defaultOptions = {
				mainElement: '#swup'
			};

			_this.options = _extends({}, defaultOptions, options);
			return _this;
		}

		_createClass(FadeTheme, [{
			key: 'mount',
			value: function mount() {
				this.applyStyles(_index2.default);
				this.addClassName(this.options.mainElement, 'main');
			}
		}]);

		return FadeTheme;
	}(_theme2.default);

	exports.default = FadeTheme;

	/***/ }),
	/* 2 */
	/***/ (function(module, exports, __webpack_require__) {


	Object.defineProperty(exports, "__esModule", {
		value: true
	});

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var Theme = function () {
		function Theme() {
			var _this = this;

			_classCallCheck(this, Theme);

			this._addedStyleElements = [];
			this._addedHTMLContent = [];
			this._classNameAddedToElements = [];

			this._addClassNameToElement = function () {
				_this._classNameAddedToElements.forEach(function (item) {
					var elements = Array.prototype.slice.call(document.querySelectorAll(item.selector));
					elements.forEach(function (element) {
						element.classList.add('swup-transition-' + item.name);
					});
				});
			};

			this.isSwupPlugin = true;
		}

		_createClass(Theme, [{
			key: '_beforeMount',
			value: function _beforeMount() {
				// save original and replace animationSelector option
				this._originalAnimationSelectorOption = String(this.swup.options.animationSelector);
				this.swup.options.animationSelector = '[class*="swup-transition-"]';

				// add classes after each content replace
				this.swup.on('contentReplaced', this._addClassNameToElement);
			}
		}, {
			key: '_afterUnmount',
			value: function _afterUnmount() {
				// reset animationSelector option
				this.swup.options.animationSelector = this._originalAnimationSelectorOption;

				// remove added styles
				this._addedStyleElements.forEach(function (element) {
					element.outerHTML = '';
					element = null;
				});

				// remove added HTML
				this._addedHTMLContent.forEach(function (element) {
					element.outerHTML = '';
					element = null;
				});

				// remove added classnames
				this._classNameAddedToElements.forEach(function (item) {
					var elements = Array.prototype.slice.call(document.querySelectorAll(item.selector));
					elements.forEach(function (element) {
						element.className.split(' ').forEach(function (classItem) {
							if (new RegExp('^swup-transition-').test(classItem)) {
								element.classList.remove(classItem);
							}
						});
					});
				});

				this.swup.off('contentReplaced', this._addClassNameToElement);
			}
		}, {
			key: 'mount',
			value: function mount() {
				// this is mount method rewritten by class extending
				// and is executed when swup is enabled with theme
			}
		}, {
			key: 'unmount',
			value: function unmount() {
				// this is unmount method rewritten by class extending
				// and is executed when swup with theme is disabled
			}
		}, {
			key: 'applyStyles',
			value: function applyStyles(styles) {
				var head = document.head;
				var style = document.createElement('style');

				style.setAttribute('data-swup-theme', '');
				style.appendChild(document.createTextNode(styles));

				this._addedStyleElements.push(style);
				head.prepend(style);
			}
		}, {
			key: 'applyHTML',
			value: function applyHTML(content) {
				var element = document.createElement('div');
				element.innerHTML = content;
				this._addedHTMLContent.push(element);
				document.body.appendChild(element);
			}
		}, {
			key: 'addClassName',
			value: function addClassName(selector, name) {
				// save so it can be later removed
				this._classNameAddedToElements.push({ selector: selector, name: name });

				// add class the first time
				this._addClassNameToElement();
			}

			// this is here so we can tell if plugin was created by extending this class

		}]);

		return Theme;
	}();

	exports.default = Theme;

	/***/ }),
	/* 3 */
	/***/ (function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(4)(false);
	// Module
	exports.push([module.i, ".swup-transition-main {\n    opacity: 1;\n    transition: opacity .4s;\n}\n\nhtml.is-animating .swup-transition-main {\n    opacity: 0;\n}", ""]);



	/***/ }),
	/* 4 */
	/***/ (function(module, exports, __webpack_require__) {


	/*
	  MIT License http://www.opensource.org/licenses/mit-license.php
	  Author Tobias Koppers @sokra
	*/
	// css base code, injected by the css-loader
	module.exports = function (useSourceMap) {
	  var list = []; // return the list of modules as css string

	  list.toString = function toString() {
	    return this.map(function (item) {
	      var content = cssWithMappingToString(item, useSourceMap);

	      if (item[2]) {
	        return '@media ' + item[2] + '{' + content + '}';
	      } else {
	        return content;
	      }
	    }).join('');
	  }; // import a list of modules into the list


	  list.i = function (modules, mediaQuery) {
	    if (typeof modules === 'string') {
	      modules = [[null, modules, '']];
	    }

	    var alreadyImportedModules = {};

	    for (var i = 0; i < this.length; i++) {
	      var id = this[i][0];

	      if (id != null) {
	        alreadyImportedModules[id] = true;
	      }
	    }

	    for (i = 0; i < modules.length; i++) {
	      var item = modules[i]; // skip already imported module
	      // this implementation is not 100% perfect for weird media query combinations
	      // when a module is imported multiple times with different media queries.
	      // I hope this will never occur (Hey this way we have smaller bundles)

	      if (item[0] == null || !alreadyImportedModules[item[0]]) {
	        if (mediaQuery && !item[2]) {
	          item[2] = mediaQuery;
	        } else if (mediaQuery) {
	          item[2] = '(' + item[2] + ') and (' + mediaQuery + ')';
	        }

	        list.push(item);
	      }
	    }
	  };

	  return list;
	};

	function cssWithMappingToString(item, useSourceMap) {
	  var content = item[1] || '';
	  var cssMapping = item[3];

	  if (!cssMapping) {
	    return content;
	  }

	  if (useSourceMap && typeof btoa === 'function') {
	    var sourceMapping = toComment(cssMapping);
	    var sourceURLs = cssMapping.sources.map(function (source) {
	      return '/*# sourceURL=' + cssMapping.sourceRoot + source + ' */';
	    });
	    return [content].concat(sourceURLs).concat([sourceMapping]).join('\n');
	  }

	  return [content].join('\n');
	} // Adapted from convert-source-map (MIT)


	function toComment(sourceMap) {
	  // eslint-disable-next-line no-undef
	  var base64 = btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap))));
	  var data = 'sourceMappingURL=data:application/json;charset=utf-8;base64,' + base64;
	  return '/*# ' + data + ' */';
	}

	/***/ })
	/******/ ]);
	});
	}(lib$2));

	var SwupFadeTheme = /*@__PURE__*/getDefaultExportFromCjs(lib$2.exports);

	var lib$1 = {};

	Object.defineProperty(lib$1, "__esModule", {
	    value: true
	});

	var _createClass$2 = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	var _plugin$1 = lib$4;

	var _plugin2$1 = _interopRequireDefault$1(_plugin$1);

	var _delegateIt = require$$1;

	var _delegateIt2 = _interopRequireDefault$1(_delegateIt);

	var _utils = utils;

	var _helpers = helpers;

	function _interopRequireDefault$1(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _classCallCheck$2(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	function _possibleConstructorReturn$1(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

	function _inherits$1(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

	var PreloadPlugin = function (_Plugin) {
	    _inherits$1(PreloadPlugin, _Plugin);

	    function PreloadPlugin() {
	        var _ref;

	        var _temp, _this, _ret;

	        _classCallCheck$2(this, PreloadPlugin);

	        for (var _len = arguments.length, args = Array(_len), _key = 0; _key < _len; _key++) {
	            args[_key] = arguments[_key];
	        }

	        return _ret = (_temp = (_this = _possibleConstructorReturn$1(this, (_ref = PreloadPlugin.__proto__ || Object.getPrototypeOf(PreloadPlugin)).call.apply(_ref, [this].concat(args))), _this), _this.name = "PreloadPlugin", _this.onContentReplaced = function () {
	            _this.swup.preloadPages();
	        }, _this.onMouseover = function (event) {
	            var swup = _this.swup;

	            swup.triggerEvent('hoverLink', event);

	            var link = new _helpers.Link(event.delegateTarget);
	            if (link.getAddress() !== (0, _helpers.getCurrentUrl)() && !swup.cache.exists(link.getAddress()) && swup.preloadPromise == null) {
	                swup.preloadPromise = swup.preloadPage(link.getAddress());
	                swup.preloadPromise.route = link.getAddress();
	                swup.preloadPromise.finally(function () {
	                    swup.preloadPromise = null;
	                });
	            }
	        }, _this.preloadPage = function (pathname) {
	            var swup = _this.swup;

	            var link = new _helpers.Link(pathname);
	            return new Promise(function (resolve, reject) {
	                if (!swup.cache.exists(link.getAddress())) {
	                    (0, _helpers.fetch)({ url: link.getAddress(), headers: swup.options.requestHeaders }, function (response) {
	                        if (response.status === 500) {
	                            swup.triggerEvent('serverError');
	                            reject(link.getAddress());
	                        } else {
	                            // get json data
	                            var page = swup.getPageData(response);
	                            if (page != null) {
	                                page.url = link.getAddress();
	                                swup.cache.cacheUrl(page);
	                                swup.triggerEvent('pagePreloaded');
	                                resolve(page);
	                            } else {
	                                reject(link.getAddress());
	                                return;
	                            }
	                        }
	                    });
	                } else {
	                    resolve(swup.cache.getPage(link.getAddress()));
	                }
	            });
	        }, _this.preloadPages = function () {
	            (0, _utils.queryAll)('[data-swup-preload]').forEach(function (element) {
	                _this.swup.preloadPage(element.href);
	            });
	        }, _temp), _possibleConstructorReturn$1(_this, _ret);
	    }

	    _createClass$2(PreloadPlugin, [{
	        key: 'mount',
	        value: function mount() {
	            var swup = this.swup;

	            if (!swup.options.cache) {
	                console.warn('PreloadPlugin: swup cache needs to be enabled for preloading');
	                return;
	            }

	            swup._handlers.pagePreloaded = [];
	            swup._handlers.hoverLink = [];

	            swup.preloadPage = this.preloadPage;
	            swup.preloadPages = this.preloadPages;

	            // register mouseover handler
	            swup.delegatedListeners.mouseover = (0, _delegateIt2.default)(document.body, swup.options.linkSelector, 'mouseover', this.onMouseover.bind(this));

	            // initial preload of links with [data-swup-preload] attr
	            swup.preloadPages();

	            // do the same on every content replace
	            swup.on('contentReplaced', this.onContentReplaced);

	            // cache unmodified dom of initial/current page
	            swup.preloadPage((0, _helpers.getCurrentUrl)());
	        }
	    }, {
	        key: 'unmount',
	        value: function unmount() {
	            var swup = this.swup;

	            if (!swup.options.cache) {
	                return;
	            }

	            swup._handlers.pagePreloaded = null;
	            swup._handlers.hoverLink = null;

	            swup.preloadPage = null;
	            swup.preloadPages = null;

	            swup.delegatedListeners.mouseover.destroy();

	            swup.off('contentReplaced', this.onContentReplaced);
	        }
	    }]);

	    return PreloadPlugin;
	}(_plugin2$1.default);

	var _default$1 = lib$1.default = PreloadPlugin;

	var lib = {};

	var ProgressBar$1 = {};

	Object.defineProperty(ProgressBar$1, "__esModule", {
		value: true
	});

	var _createClass$1 = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	function _classCallCheck$1(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	var ProgressBar = function () {
		function ProgressBar() {
			var _this = this;

			var _ref = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {},
			    _ref$className = _ref.className,
			    className = _ref$className === undefined ? 'progress-bar' : _ref$className,
			    _ref$styleAttr = _ref.styleAttr,
			    styleAttr = _ref$styleAttr === undefined ? 'data-progressbar-styles' : _ref$styleAttr,
			    _ref$animationDuratio = _ref.animationDuration,
			    animationDuration = _ref$animationDuratio === undefined ? 300 : _ref$animationDuratio,
			    _ref$minValue = _ref.minValue,
			    minValue = _ref$minValue === undefined ? 0.1 : _ref$minValue,
			    _ref$initialValue = _ref.initialValue,
			    initialValue = _ref$initialValue === undefined ? 0.25 : _ref$initialValue,
			    _ref$trickleValue = _ref.trickleValue,
			    trickleValue = _ref$trickleValue === undefined ? 0.03 : _ref$trickleValue;

			_classCallCheck$1(this, ProgressBar);

			this.styleElement = null;
			this.progressElement = null;
			this.value = 0;
			this.visible = false;
			this.hiding = false;
			this.trickleInterval = null;

			this.trickle = function () {
				var advance = Math.random() * _this.trickleValue;
				_this.setValue(_this.value + advance);
			};

			this.className = className;
			this.styleAttr = styleAttr;
			this.animationDuration = animationDuration;
			this.minValue = minValue;
			this.initialValue = initialValue;
			this.trickleValue = trickleValue;

			this.styleElement = this.createStyleElement();
			this.progressElement = this.createProgressElement();
		}

		_createClass$1(ProgressBar, [{
			key: 'show',
			value: function show() {
				if (!this.visible) {
					this.visible = true;
					this.installStyleElement();
					this.installProgressElement();
					this.startTrickling();
				}
			}
		}, {
			key: 'hide',
			value: function hide() {
				var _this2 = this;

				if (this.visible && !this.hiding) {
					this.hiding = true;
					this.fadeProgressElement(function () {
						_this2.uninstallProgressElement();
						_this2.stopTrickling();
						_this2.visible = false;
						_this2.hiding = false;
					});
				}
			}
		}, {
			key: 'setValue',
			value: function setValue(value) {
				this.value = Math.min(1, Math.max(this.minValue, value));
				this.refresh();
			}

			// Private

		}, {
			key: 'installStyleElement',
			value: function installStyleElement() {
				document.head.insertBefore(this.styleElement, document.head.firstChild);
			}
		}, {
			key: 'installProgressElement',
			value: function installProgressElement() {
				this.progressElement.style.width = '0%';
				this.progressElement.style.opacity = '1';
				document.documentElement.insertBefore(this.progressElement, document.body);
				this.progressElement.scrollTop = 0; // Force reflow to ensure initial style takes effect
				this.setValue(Math.random() * this.initialValue);
			}
		}, {
			key: 'fadeProgressElement',
			value: function fadeProgressElement(callback) {
				this.progressElement.style.opacity = '0';
				setTimeout(callback, this.animationDuration * 1.5);
			}
		}, {
			key: 'uninstallProgressElement',
			value: function uninstallProgressElement() {
				if (this.progressElement.parentNode) {
					document.documentElement.removeChild(this.progressElement);
				}
			}
		}, {
			key: 'startTrickling',
			value: function startTrickling() {
				if (!this.trickleInterval) {
					this.trickleInterval = window.setInterval(this.trickle, this.animationDuration);
				}
			}
		}, {
			key: 'stopTrickling',
			value: function stopTrickling() {
				window.clearInterval(this.trickleInterval);
				delete this.trickleInterval;
			}
		}, {
			key: 'refresh',
			value: function refresh() {
				var _this3 = this;

				requestAnimationFrame(function () {
					_this3.progressElement.style.width = _this3.value * 100 + '%';
				});
			}
		}, {
			key: 'createStyleElement',
			value: function createStyleElement() {
				var element = document.createElement('style');
				element.setAttribute(this.styleAttr, '');
				element.textContent = this.defaultStyles;
				return element;
			}
		}, {
			key: 'createProgressElement',
			value: function createProgressElement() {
				var element = document.createElement('div');
				element.className = this.className;
				return element;
			}
		}, {
			key: 'defaultStyles',
			get: function get() {
				return '\n\t\t.' + this.className + ' {\n\t\t\t\tposition: fixed;\n\t\t\t\tdisplay: block;\n\t\t\t\ttop: 0;\n\t\t\t\tleft: 0;\n\t\t\t\theight: 3px;\n\t\t\t\tbackground-color: black;\n\t\t\t\tz-index: 9999;\n\t\t\t\ttransition:\n\t\t\t\t\twidth ' + this.animationDuration + 'ms ease-out,\n\t\t\t\t\topacity ' + this.animationDuration / 2 + 'ms ' + this.animationDuration / 2 + 'ms ease-in;\n\t\t\t\ttransform: translate3d(0, 0, 0);\n\t\t\t}\n\t\t';
			}
		}]);

		return ProgressBar;
	}();

	ProgressBar$1.default = ProgressBar;

	Object.defineProperty(lib, "__esModule", {
		value: true
	});

	var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

	var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

	var _plugin = lib$4;

	var _plugin2 = _interopRequireDefault(_plugin);

	var _ProgressBar = ProgressBar$1;

	var _ProgressBar2 = _interopRequireDefault(_ProgressBar);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

	function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

	function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

	var SwupProgressPlugin = function (_Plugin) {
		_inherits(SwupProgressPlugin, _Plugin);

		function SwupProgressPlugin() {
			var options = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};

			_classCallCheck(this, SwupProgressPlugin);

			var _this = _possibleConstructorReturn(this, (SwupProgressPlugin.__proto__ || Object.getPrototypeOf(SwupProgressPlugin)).call(this));

			_this.name = 'SwupProgressPlugin';

			_this.startShowingProgress = function () {
				_this.progressBar.setValue(0);
				_this.showProgressBarAfterDelay();
			};

			_this.stopShowingProgress = function () {
				_this.progressBar.setValue(1);
				if (_this.options.hideImmediately) {
					_this.hideProgressBar();
				} else {
					_this.finishAnimationAndHideProgressBar();
				}
			};

			_this.showProgressBar = function () {
				_this.cancelHideProgressBarTimeout();
				_this.progressBar.show();
			};

			_this.showProgressBarAfterDelay = function () {
				_this.cancelShowProgressBarTimeout();
				_this.cancelHideProgressBarTimeout();
				_this.showProgressBarTimeout = window.setTimeout(_this.showProgressBar, _this.options.delay);
			};

			_this.hideProgressBar = function () {
				_this.cancelShowProgressBarTimeout();
				_this.progressBar.hide();
			};

			_this.finishAnimationAndHideProgressBar = function () {
				_this.cancelShowProgressBarTimeout();
				_this.hideProgressBarTimeout = window.setTimeout(_this.hideProgressBar, _this.options.transition);
			};

			_this.cancelShowProgressBarTimeout = function () {
				window.clearTimeout(_this.showProgressBarTimeout);
				delete _this.showProgressBarTimeout;
			};

			_this.cancelHideProgressBarTimeout = function () {
				window.clearTimeout(_this.hideProgressBarTimeout);
				delete _this.hideProgressBarTimeout;
			};

			var defaultOptions = {
				className: 'swup-progress-bar',
				delay: 300,
				transition: undefined,
				minValue: undefined,
				initialValue: undefined,
				hideImmediately: true
			};

			_this.options = _extends({}, defaultOptions, options);

			_this.showProgressBarTimeout = null;
			_this.hideProgressBarTimeout = null;

			_this.progressBar = new _ProgressBar2.default({
				className: _this.options.className,
				animationDuration: _this.options.transition,
				minValue: _this.options.minValue,
				initialValue: _this.options.initialValue
			});
			return _this;
		}

		_createClass(SwupProgressPlugin, [{
			key: 'mount',
			value: function mount() {
				this.swup.on('transitionStart', this.startShowingProgress);
				this.swup.on('contentReplaced', this.stopShowingProgress);
			}
		}, {
			key: 'unmount',
			value: function unmount() {
				this.swup.off('transitionStart', this.startShowingProgress);
				this.swup.off('contentReplaced', this.stopShowingProgress);
			}
		}]);

		return SwupProgressPlugin;
	}(_plugin2.default);

	var _default = lib.default = SwupProgressPlugin;

	// import SwupScriptsPlugin from '@swup/scripts-plugin';
	// import SwupDebugPlugin from '@swup/debug-plugin';
	// import SwupHeadPlugin from '@swup/head-plugin';
	// import SwupGaPlugin from '@swup/ga-plugin';
	// import SwupGtagPlugin from 'swup-gtag-plugin';
	// import anime from 'animejs/lib/anime.es.js';

	const options = {
	    containers: ["#swup", "#navbar", "#mobile-menu"],
	    animationSelector: '[class*="transition-fade"]',
	    linkSelector:
	        'a[href^="' + window.location.origin +'"]:not([data-no-swup]):not([target="_blank"]):not([download]):not([href$=".pdf"]), ' +
	        'a[href^="/"]:not([data-no-swup]):not([target="_blank"]):not([download]):not([href$=".pdf"]), ' +
	        'a[href^="#"]:not([data-no-swup]):not([target="_blank"]):not([download]):not([href$=".pdf"])',
	    animateHistoryBrowsing: false,
	    cache: true,
	    plugins: [
	        new _default$2({
	            animateScroll: false
	        }),      
	        new SwupFadeTheme(),
	        new _default$1(),
	        new _default(
	            {
	            className: 'tm-progress-bar',
	            transition: 300,
	            delay: 300
	            }   
	        )     
	    ]
	};

	const swup = new _default$3(options);

	let scrollValues = {};

	swup.on('clickLink', () => {
	    scrollValues[window.location.href] = window.scrollY;
	    if(document.getElementById("offcanvas").classList.contains("uk-open")) {
	        UIkit.offcanvas('#offcanvas').hide();
	    }
	    
	});

	swup.on('popState', () => {
	    setTimeout(function() {
	        window.scrollTo(0, scrollValues[window.location.href]);
	    }, 100);
	});

	swup.on('contentReplaced', function() {
	    // quantity
	    if(document.querySelector('#quantity') != null) ;
	    // quantity
	    if(document.querySelector('.snipcart-items-count') != null) ;
	});

})();
