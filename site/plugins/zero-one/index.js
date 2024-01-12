panel.plugin("zero/zero-one", {
  blocks: {
    audio: {
      data() {
        return {
          mime: null
        };
      },
      computed: {
        poster() {
          return this.content.poster[0] || {};
        },
        source() {
          return this.content.source[0] || {};
        }
      },
      watch: {
        "source.link": {
          handler (link) {
            if (link) {
              this.$api.get(link).then(file => {
                this.mime = file.mime;
              });
            }
          },
          immediate: true
        }
      },
      template: `
      <k-block-figure
      :is-empty="!source.url"
      empty-icon="audio-file"
      empty-text="No file selected yet …"
      @open="open"
      @update="update"
    >
      <div class="k-block-type-audio-wrapper">
        <div>
          <k-aspect-ratio
            class="k-block-type-audio-poster"
            cover="true"
            ratio="1/1"
          >
            <img
              v-if="poster.url"
              :src="poster.url"
              alt=""
            >
          </k-aspect-ratio>
        </div>
        <div class="k-block-type-audio-content" @dblclick.stop>
          <k-writer
            :inline="true"
            :marks="false"
            :placeholder="field('title').placeholder"
            :value="content.title"
            class="k-block-type-audio-title"
            @input="update({ title: $event })"
          />
          <k-writer
            :inline="true"
            :marks="false"
            :placeholder="field('subtitle').placeholder"
            :value="content.subtitle"
            class="k-block-type-audio-subtitle"
            @input="update({ subtitle: $event })"
          />
          <k-writer
            :inline="true"
            :marks="false"
            :placeholder="field('description').placeholder"
            :value="content.description"
            class="k-block-type-audio-description"
            @input="update({ description: $event })"
          />
          <audio class="k-block-type-audio-element" controls>
            <source :src="source.url" :type="mime">
          </audio>
        </div>
      </div>
    </k-block-figure>
      `
    },
    accordion: {
      computed: {
        items() {
          return this.content.accordion || {};
        }
      },
      methods: {
        updateItem(content, index, fieldName, value) {
          content.accordion[index][fieldName] = value;
          this.$emit("update", {
              ...this.content,
              ...content
            });
        }
      },
      template: `
        <div @dblclick="open">
          <div v-if="items.length">
            <details v-for="(item, index) in items" :key="index">
              <summary>
                <k-writer
                  ref="question"
                  :inline="true"
                  :marks="false"
                  :value="item.question"
                  @input="updateItem(content, index, 'question', $event)"
                />
              </summary>
              <k-writer
                class="label"
                ref="answer"
                :marks="true"
                :value="item.answer"
                @input="updateItem(content, index, 'answer', $event)"
              />
            </details>
          </div>
          <div v-else>No questions yet</div>
        </div>
      `
    },
    articles: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-list-bullet"><svg viewBox="0 0 16 16"><use xlink:href="#icon-list-bullet"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-list-bullet"><svg viewBox="0 0 16 16"><use xlink:href="#icon-list-bullet"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    banner: {
      data() {
        return {
          renderedText: {},
        };
      },
      
      created() {
        this.kt();
      },
      methods: {
        kt() {
            const data = {
              text: this.text,
            };
            this.$api
              .post('getRenderedText/' + this.$attrs.endpoints.model, data)
              .then(data => {
                this.renderedText = data.text.value;
              });
          }
      },
      computed: {
        empty() {
          if (!this.content.image[0]) {
            return true;
          }
          return false;
        },
        image() {
          return this.content.image[0];
        },
        heading() {
          return this.content.heading;
        },
        text() {
          return this.content.text || '';
        },
      },
      watch: {
        "text": {
          handler (text) {
              const data = {
               text: this.text,
              };
              this.$api
              .post('getRenderedText/' + this.$attrs.endpoints.model, data)
              .then(data => {
                this.renderedText = data.text.value;
              });
            }
          },
          immediate: true
      },
      template: `
        <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-file-image"><svg viewBox="0 0 16 16"><use xlink:href="#icon-file-image"></use></svg></span><span class="k-button-text">Select banner image...</span></button></figure>
        <div @dblclick="open" v-else>
          <k-aspect-ratio
            class="k-block-type-banner-image"
            cover="true"
            ratio="3/2"
          >
            <img
              v-if="image.url"
              :src="image.url"
              alt=""
            >
          </k-aspect-ratio>
          <div class="k-block-type-banner-overlay-content">
          <div v-if="text">
            <div class="content-wrapper" v-html="renderedText"/>
            </div>
            <div v-else>
            No content yet
          </div>
          </div>
        </div>
      `
    },
    button: {
      computed: {
        placeholder() {
          return "Button text …";
        }
      },
      template: `
        <input
          @dblclick="open"
          type="text"
          :placeholder="placeholder"
          :value="content.text"
          @input="update({ text: $event.target.value })"
        />
      `
    },
    'contact-form': {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-email"><svg viewBox="0 0 16 16"><use xlink:href="#icon-email"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-email"><svg viewBox="0 0 16 16"><use xlink:href="#icon-email"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    cpt: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-bolt"><svg viewBox="0 0 16 16"><use xlink:href="#icon-bolt"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-bolt"><svg viewBox="0 0 16 16"><use xlink:href="#icon-bolt"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    editor: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-edit"><svg viewBox="0 0 16 16"><use xlink:href="#icon-edit"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-edit"><svg viewBox="0 0 16 16"><use xlink:href="#icon-edit"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    gallery: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-image"><svg viewBox="0 0 16 16"><use xlink:href="#icon-image"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-image"><svg viewBox="0 0 16 16"><use xlink:href="#icon-image"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    'gallery-article': {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
      <template>
        <ul @dblclick="open">
          <template v-if="content.images.length === 0">
            <li />
            <li />
            <li />
            <li />
            <li />
          </template>
          <template v-else>
            <li v-for="image in content.images" :key="image.id">
              <img :src="image.url" :alt="image.alt">
            </li>
          </template>
        </ul>
      </template>
      `
    },
    grid: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-dashboard"><svg viewBox="0 0 16 16"><use xlink:href="#icon-dashboard"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-dashboard"><svg viewBox="0 0 16 16"><use xlink:href="#icon-dashboard"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    hero: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-star"><svg viewBox="0 0 16 16"><use xlink:href="#icon-star"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-star"><svg viewBox="0 0 16 16"><use xlink:href="#icon-star"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    info: {
      computed: {
          placeholder() {
          return "Info text …";
          }
      },
      template: `
          <input
          type="info"
          :placeholder="placeholder"
          :value="content.text"
          @input="update({ text: $event.target.value })"
          />
      `
    },
    intro: {
      computed: {
          placeholder() {
          return "Intro text …";
          }
      },
      template: `
          <input
          type="intro"
          :placeholder="placeholder"
          :value="content.text"
          @input="update({ text: $event.target.value })"
          />
      `
    },
    'media-video': {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-file-video"><svg viewBox="0 0 16 16"><use xlink:href="#icon-file-video"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-file-video"><svg viewBox="0 0 16 16"><use xlink:href="#icon-file-video"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    'media-image': {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-file-image"><svg viewBox="0 0 16 16"><use xlink:href="#icon-file-image"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-file-image"><svg viewBox="0 0 16 16"><use xlink:href="#icon-file-image"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    slider: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-copy"><svg viewBox="0 0 16 16"><use xlink:href="#icon-copy"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-copy"><svg viewBox="0 0 16 16"><use xlink:href="#icon-copy"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    slideshow: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-layers"><svg viewBox="0 0 16 16"><use xlink:href="#icon-layers"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-layers"><svg viewBox="0 0 16 16"><use xlink:href="#icon-layers"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    subgrid: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-dashboard"><svg viewBox="0 0 16 16"><use xlink:href="#icon-dashboard"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-dashboard"><svg viewBox="0 0 16 16"><use xlink:href="#icon-dashboard"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    table: {
      inheritAttrs: false,
      computed: {
        columns() {
          return this.table.columns || this.table.fields || {};
        },
        columnsCount() {
          return Object.keys(this.columns).length;
        },
        rows() {
          if (this.content.number === "two") {
            return this.content.two || [];
          }
          if (this.content.number === "three") {
            return this.content.three || [];
          }
          if (this.content.number === "four") {
            return this.content.four || [];
          }
          if (this.content.number === "five") {
            return this.content.five || [];
          }
          return false;
          
        },
        table() {
          let table = null;
          if (this.content.number === "two") {
            Object.values(this.fieldset.tabs).forEach(tab => {
              if (tab.fields.two) {
                table = tab.fields.two;
              }
            });
          }
          if (this.content.number === "three") {
            Object.values(this.fieldset.tabs).forEach(tab => {
              if (tab.fields.three) {
                table = tab.fields.three;
              }
            });
          }
          if (this.content.number === "four") {
            Object.values(this.fieldset.tabs).forEach(tab => {
              if (tab.fields.four) {
                table = tab.fields.four;
              }
            });
          }
          if (this.content.number === "five") {
            Object.values(this.fieldset.tabs).forEach(tab => {
              if (tab.fields.five) {
                table = tab.fields.five;
              }
            });
          }
          return table || {};
        }
      },
      template: `
      <template>
        <table class="k-block-type-table-preview" @dblclick="open">
            <th :colspan="columnsCount">
              Table
            </th>
          <tr v-if="rows.length === 0">
            <td :colspan="columnsCount">
              <small class="k-block-type-table-preview-empty">{{ $t('field.structure.empty') }}</small>
            </td>
          </tr>
          <tr v-for="(row, rowIndex) in rows" v-else :key="rowIndex">
            <td
              v-for="(column, columnName) in columns"
              :key="rowIndex + '-' + columnName"
              :data-align="column.align"
            >
              {{ column.before }} {{ row[columnName] }} {{ column.after }}
            </td>
          </tr>
        </table>
      </template>
      `
    },
    'text-image': {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-file-document"><svg viewBox="0 0 16 16"><use xlink:href="#icon-file-document"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-file-document"><svg viewBox="0 0 16 16"><use xlink:href="#icon-file-document"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    projects: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-list-numbers"><svg viewBox="0 0 16 16"><use xlink:href="#icon-list-numbers"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-list-numbers"><svg viewBox="0 0 16 16"><use xlink:href="#icon-list-numbers"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    products: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-cart"><svg viewBox="0 0 16 16"><use xlink:href="#icon-cart"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-cart"><svg viewBox="0 0 16 16"><use xlink:href="#icon-cart"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    zpages: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-list-bullet"><svg viewBox="0 0 16 16"><use xlink:href="#icon-list-bullet"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-list-bullet"><svg viewBox="0 0 16 16"><use xlink:href="#icon-list-bullet"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    ztable: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-table"><svg viewBox="0 0 16 16"><use xlink:href="#icon-table"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-table"><svg viewBox="0 0 16 16"><use xlink:href="#icon-table"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    zhtml: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-code"><svg viewBox="0 0 16 16"><use xlink:href="#icon-code"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-code"><svg viewBox="0 0 16 16"><use xlink:href="#icon-code"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    zimageslider: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-images"><svg viewBox="0 0 16 16"><use xlink:href="#icon-images"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-images"><svg viewBox="0 0 16 16"><use xlink:href="#icon-images"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    zcontentslider: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-layers"><svg viewBox="0 0 16 16"><use xlink:href="#icon-layers"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-layers"><svg viewBox="0 0 16 16"><use xlink:href="#icon-layers"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    zcard: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-grid-full"><svg viewBox="0 0 16 16"><use xlink:href="#icon-grid-full"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-grid-full"><svg viewBox="0 0 16 16"><use xlink:href="#icon-grid-full"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    zdescription: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-text"><svg viewBox="0 0 16 16"><use xlink:href="#icon-text"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-text"><svg viewBox="0 0 16 16"><use xlink:href="#icon-text"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    ztypedtext: {
      computed: {
        empty() {
          if (!this.content.title) {
            return true;
          }
          return false;
        }
      },
      template: `
        <template>
          <figure @dblclick="open" v-if="empty" class="k-block-figure"><button class="k-block-figure-empty k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-text-left"><svg viewBox="0 0 16 16"><use xlink:href="#icon-text-left"></use></svg></span><span class="k-button-text">{{ fieldset.name }}</span></button></figure>
          <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-text-left"><svg viewBox="0 0 16 16"><use xlink:href="#icon-text-left"></use></svg></span><span class="k-button-text">{{ fieldset.name }}: {{ content.title }}</span></button></figure>
        </template>
      `
    },
    video: {
      computed: {
          captionMarks() {
            return this.field("caption", { marks: true }).marks;
          },
          videourl() {
            if (this.content.videosource === "upload") {
              return false;
            }

            var url = this.content.url;
            if (!url) {
              return false;
            }
            var youtubePattern = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
            var youtubeMatch = url.match(youtubePattern);
            if (youtubeMatch) {
              return "https://www.youtube.com/embed/" + youtubeMatch[2];
            }
            var vimeoPattern = /vimeo\.com\/([0-9]+)/;
            var vimeoMatch = url.match(vimeoPattern);
            if (vimeoMatch) {
              return "https://player.vimeo.com/video/" + vimeoMatch[1];
            }
            return false;
          },
          videofile() {
            if (this.content.videosource === "url") {
              return false;
            }
              return this.content.videofile[0] || false;
          }
      },
      template: `
      <template>
      <k-block-figure v-if="videourl"
        :caption="content.caption"
        :caption-marks="captionMarks"
        @open="open"
        @update="update"
      >
        <k-aspect-ratio ratio="16/9">
          <iframe :src="videourl" />
        </k-aspect-ratio>
      </k-block-figure>

      <k-block-figure v-else-if="videofile"
        :caption="content.caption"
        :caption-marks="captionMarks"
        @open="open"
        @update="update"
      >
        <k-aspect-ratio ratio="16/9">
        <video>
          <source :src="videofile.url">
        </video>
        </k-aspect-ratio>
      </k-block-figure>

      <figure @dblclick="open" v-else class="k-block-figure"><button class="k-block-figure-empty k-block-figure-source k-button" type="button"><span aria-hidden="true" class="k-button-icon k-icon k-icon-video"><svg viewBox="0 0 16 16"><use xlink:href="#icon-video"></use></svg></span><span class="k-button-text">Add a video...</span></button></figure>
      </template>
      `
    }

  }
});