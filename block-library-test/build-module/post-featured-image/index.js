/**
 * WordPress dependencies
 */
import { postFeaturedImage as icon } from '@wordpress/icons';

/**
 * Internal dependencies
 */
import initBlock from '../utils/init-block';
const metadata = {
  $schema: "https://schemas.wp.org/trunk/block.json",
  apiVersion: 3,
  name: "core/post-featured-image",
  title: "Featured Image",
  category: "theme",
  description: "Display a post's featured image.",
  textdomain: "default",
  attributes: {
    isLink: {
      type: "boolean",
      "default": false
    },
    aspectRatio: {
      type: "string"
    },
    width: {
      type: "string"
    },
    height: {
      type: "string"
    },
    scale: {
      type: "string",
      "default": "cover"
    },
    sizeSlug: {
      type: "string"
    },
    rel: {
      type: "string",
      attribute: "rel",
      "default": ""
    },
    linkTarget: {
      type: "string",
      "default": "_self"
    },
    overlayColor: {
      type: "string"
    },
    customOverlayColor: {
      type: "string"
    },
    dimRatio: {
      type: "number",
      "default": 0
    },
    gradient: {
      type: "string"
    },
    customGradient: {
      type: "string"
    },
    useFirstImageFromPost: {
      type: "boolean",
      "default": false
    }
  },
  usesContext: ["postId", "postType", "queryId"],
  supports: {
    align: ["left", "right", "center", "wide", "full"],
    color: {
      __experimentalDuotone: "img, .wp-block-post-featured-image__placeholder, .components-placeholder__illustration, .components-placeholder::before",
      text: false,
      background: false
    },
    __experimentalBorder: {
      color: true,
      radius: true,
      width: true,
      __experimentalSelector: "img, .block-editor-media-placeholder, .wp-block-post-featured-image__overlay",
      __experimentalSkipSerialization: true,
      __experimentalDefaultControls: {
        color: true,
        radius: true,
        width: true
      }
    },
    html: false,
    spacing: {
      margin: true,
      padding: true
    }
  },
  editorStyle: "wp-block-post-featured-image-editor",
  style: "wp-block-post-featured-image"
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