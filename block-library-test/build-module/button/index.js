/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { button as icon } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import initBlock from '../utils/init-block';
import deprecated from './deprecated';
import edit from './edit';
const metadata = {
  $schema: "https://schemas.wp.org/trunk/block.json",
  apiVersion: 3,
  name: "core/button",
  title: "Button",
  category: "design",
  parent: ["core/buttons"],
  description: "Prompt visitors to take action with a button-style link.",
  keywords: ["link"],
  textdomain: "default",
  usesContext: ["pattern/overrides"],
  attributes: {
    tagName: {
      type: "string",
      "enum": ["a", "button"],
      "default": "a"
    },
    type: {
      type: "string",
      "default": "button"
    },
    textAlign: {
      type: "string"
    },
    url: {
      type: "string",
      source: "attribute",
      selector: "a",
      attribute: "href",
      __experimentalRole: "content"
    },
    title: {
      type: "string",
      source: "attribute",
      selector: "a,button",
      attribute: "title",
      __experimentalRole: "content"
    },
    text: {
      type: "rich-text",
      source: "rich-text",
      selector: "a,button",
      __experimentalRole: "content"
    },
    linkTarget: {
      type: "string",
      source: "attribute",
      selector: "a",
      attribute: "target",
      __experimentalRole: "content"
    },
    rel: {
      type: "string",
      source: "attribute",
      selector: "a",
      attribute: "rel",
      __experimentalRole: "content"
    },
    placeholder: {
      type: "string"
    },
    backgroundColor: {
      type: "string"
    },
    textColor: {
      type: "string"
    },
    gradient: {
      type: "string"
    },
    width: {
      type: "number"
    }
  },
  supports: {
    anchor: true,
    align: false,
    alignWide: false,
    color: {
      __experimentalSkipSerialization: true,
      gradients: true,
      __experimentalDefaultControls: {
        background: true,
        text: true
      }
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
      __experimentalDefaultControls: {
        fontSize: true
      }
    },
    reusable: false,
    shadow: true,
    spacing: {
      __experimentalSkipSerialization: true,
      padding: ["horizontal", "vertical"],
      __experimentalDefaultControls: {
        padding: true
      }
    },
    __experimentalBorder: {
      color: true,
      radius: true,
      style: true,
      width: true,
      __experimentalSkipSerialization: true,
      __experimentalDefaultControls: {
        color: true,
        radius: true,
        style: true,
        width: true
      }
    },
    __experimentalSelector: ".wp-block-button .wp-block-button__link"
  },
  styles: [{
    name: "fill",
    label: "Fill",
    isDefault: true
  }, {
    name: "outline",
    label: "Outline"
  }],
  editorStyle: "wp-block-button-editor",
  style: "wp-block-button"
};
import save from './save';
const {
  name
} = metadata;
export { metadata, name };
export const settings = {
  icon,
  example: {
    attributes: {
      className: 'is-style-fill',
      text: __('Call to Action')
    }
  },
  edit,
  save,
  deprecated,
  merge: (a, {
    text = ''
  }) => ({
    ...a,
    text: (a.text || '') + text
  })
};
export const init = () => initBlock({
  name,
  metadata,
  settings
});
//# sourceMappingURL=index.js.map