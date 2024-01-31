/**
 * Internal dependencies
 */
import initBlock from '../utils/init-block';
const metadata = {
  $schema: "https://schemas.wp.org/trunk/block.json",
  apiVersion: 3,
  name: "core/post-navigation-link",
  title: "Post Navigation Link",
  category: "theme",
  description: "Displays the next or previous post link that is adjacent to the current post.",
  textdomain: "default",
  attributes: {
    textAlign: {
      type: "string"
    },
    type: {
      type: "string",
      "default": "next"
    },
    label: {
      type: "string"
    },
    showTitle: {
      type: "boolean",
      "default": false
    },
    linkLabel: {
      type: "boolean",
      "default": false
    },
    arrow: {
      type: "string",
      "default": "none"
    },
    taxonomy: {
      type: "string",
      "default": ""
    }
  },
  usesContext: ["postType"],
  supports: {
    reusable: false,
    html: false,
    color: {
      link: true
    },
    typography: {
      fontSize: true,
      lineHeight: true,
      __experimentalFontFamily: true,
      __experimentalFontWeight: true,
      __experimentalFontStyle: true,
      __experimentalTextTransform: true,
      __experimentalTextDecoration: true,
      __experimentalLetterSpacing: true,
      __experimentalWritingMode: true,
      __experimentalDefaultControls: {
        fontSize: true
      }
    }
  },
  style: "wp-block-post-navigation-link"
};
import edit from './edit';
import variations from './variations';
const {
  name
} = metadata;
export { metadata, name };
export const settings = {
  edit,
  variations
};
export const init = () => initBlock({
  name,
  metadata,
  settings
});
//# sourceMappingURL=index.js.map