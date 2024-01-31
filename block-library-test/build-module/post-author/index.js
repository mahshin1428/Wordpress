/**
 * WordPress dependencies
 */
import { postAuthor as icon } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import initBlock from '../utils/init-block';
const metadata = {
  $schema: "https://schemas.wp.org/trunk/block.json",
  apiVersion: 3,
  name: "core/post-author",
  title: "Author",
  category: "theme",
  description: "Display post author details such as name, avatar, and bio.",
  textdomain: "default",
  attributes: {
    textAlign: {
      type: "string"
    },
    avatarSize: {
      type: "number",
      "default": 48
    },
    showAvatar: {
      type: "boolean",
      "default": true
    },
    showBio: {
      type: "boolean"
    },
    byline: {
      type: "string"
    },
    isLink: {
      type: "boolean",
      "default": false
    },
    linkTarget: {
      type: "string",
      "default": "_self"
    }
  },
  usesContext: ["postType", "postId", "queryId"],
  supports: {
    html: false,
    spacing: {
      margin: true,
      padding: true
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
    color: {
      gradients: true,
      link: true,
      __experimentalDuotone: ".wp-block-post-author__avatar img",
      __experimentalDefaultControls: {
        background: true,
        text: true
      }
    }
  },
  style: "wp-block-post-author"
};
import edit from './edit';
const {
  name
} = metadata;
export { metadata, name };
export const settings = {
  icon,
  edit
};
export const init = () => initBlock({
  name,
  metadata,
  settings
});
//# sourceMappingURL=index.js.map