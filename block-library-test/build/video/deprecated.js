"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");
Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
var _react = require("react");
var _blockEditor = require("@wordpress/block-editor");
var _tracks = _interopRequireDefault(require("./tracks"));
/**
 * WordPress dependencies
 */
/**
 * Internal dependencies
 */
const metadata = {
  $schema: "https://schemas.wp.org/trunk/block.json",
  apiVersion: 3,
  name: "core/video",
  title: "Video",
  category: "media",
  description: "Embed a video from your media library or upload a new one.",
  keywords: ["movie"],
  textdomain: "default",
  attributes: {
    autoplay: {
      type: "boolean",
      source: "attribute",
      selector: "video",
      attribute: "autoplay"
    },
    caption: {
      type: "rich-text",
      source: "rich-text",
      selector: "figcaption",
      __experimentalRole: "content"
    },
    controls: {
      type: "boolean",
      source: "attribute",
      selector: "video",
      attribute: "controls",
      "default": true
    },
    id: {
      type: "number",
      __experimentalRole: "content"
    },
    loop: {
      type: "boolean",
      source: "attribute",
      selector: "video",
      attribute: "loop"
    },
    muted: {
      type: "boolean",
      source: "attribute",
      selector: "video",
      attribute: "muted"
    },
    poster: {
      type: "string",
      source: "attribute",
      selector: "video",
      attribute: "poster"
    },
    preload: {
      type: "string",
      source: "attribute",
      selector: "video",
      attribute: "preload",
      "default": "metadata"
    },
    src: {
      type: "string",
      source: "attribute",
      selector: "video",
      attribute: "src",
      __experimentalRole: "content"
    },
    playsInline: {
      type: "boolean",
      source: "attribute",
      selector: "video",
      attribute: "playsinline"
    },
    tracks: {
      __experimentalRole: "content",
      type: "array",
      items: {
        type: "object"
      },
      "default": []
    }
  },
  supports: {
    anchor: true,
    align: true,
    spacing: {
      margin: true,
      padding: true,
      __experimentalDefaultControls: {
        margin: false,
        padding: false
      }
    }
  },
  editorStyle: "wp-block-video-editor",
  style: "wp-block-video"
};
const {
  attributes: blockAttributes
} = metadata;

// In #41140 support was added to global styles for caption elements which added a `wp-element-caption` classname
// to the video figcaption element.
const v1 = {
  attributes: blockAttributes,
  save({
    attributes
  }) {
    const {
      autoplay,
      caption,
      controls,
      loop,
      muted,
      poster,
      preload,
      src,
      playsInline,
      tracks
    } = attributes;
    return (0, _react.createElement)("figure", {
      ..._blockEditor.useBlockProps.save()
    }, src && (0, _react.createElement)("video", {
      autoPlay: autoplay,
      controls: controls,
      loop: loop,
      muted: muted,
      poster: poster,
      preload: preload !== 'metadata' ? preload : undefined,
      src: src,
      playsInline: playsInline
    }, (0, _react.createElement)(_tracks.default, {
      tracks: tracks
    })), !_blockEditor.RichText.isEmpty(caption) && (0, _react.createElement)(_blockEditor.RichText.Content, {
      tagName: "figcaption",
      value: caption
    }));
  }
};
const deprecated = [v1];
var _default = exports.default = deprecated;
//# sourceMappingURL=deprecated.js.map