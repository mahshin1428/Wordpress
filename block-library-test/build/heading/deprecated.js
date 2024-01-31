"use strict";

var _interopRequireDefault = require("@babel/runtime/helpers/interopRequireDefault");
Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;
var _react = require("react");
var _classnames = _interopRequireDefault(require("classnames"));
var _blockEditor = require("@wordpress/block-editor");
/**
 * External dependencies
 */

/**
 * WordPress dependencies
 */

const blockSupports = {
  className: false,
  anchor: true
};
const blockAttributes = {
  align: {
    type: 'string'
  },
  content: {
    type: 'string',
    source: 'html',
    selector: 'h1,h2,h3,h4,h5,h6',
    default: ''
  },
  level: {
    type: 'number',
    default: 2
  },
  placeholder: {
    type: 'string'
  }
};
const migrateCustomColors = attributes => {
  if (!attributes.customTextColor) {
    return attributes;
  }
  const style = {
    color: {
      text: attributes.customTextColor
    }
  };
  const {
    customTextColor,
    ...restAttributes
  } = attributes;
  return {
    ...restAttributes,
    style
  };
};
const TEXT_ALIGN_OPTIONS = ['left', 'right', 'center'];
const migrateTextAlign = attributes => {
  const {
    align,
    ...rest
  } = attributes;
  return TEXT_ALIGN_OPTIONS.includes(align) ? {
    ...rest,
    textAlign: align
  } : attributes;
};
const v1 = {
  supports: blockSupports,
  attributes: {
    ...blockAttributes,
    customTextColor: {
      type: 'string'
    },
    textColor: {
      type: 'string'
    }
  },
  migrate: attributes => migrateCustomColors(migrateTextAlign(attributes)),
  save({
    attributes
  }) {
    const {
      align,
      level,
      content,
      textColor,
      customTextColor
    } = attributes;
    const tagName = 'h' + level;
    const textClass = (0, _blockEditor.getColorClassName)('color', textColor);
    const className = (0, _classnames.default)({
      [textClass]: textClass
    });
    return (0, _react.createElement)(_blockEditor.RichText.Content, {
      className: className ? className : undefined,
      tagName: tagName,
      style: {
        textAlign: align,
        color: textClass ? undefined : customTextColor
      },
      value: content
    });
  }
};
const v2 = {
  attributes: {
    ...blockAttributes,
    customTextColor: {
      type: 'string'
    },
    textColor: {
      type: 'string'
    }
  },
  migrate: attributes => migrateCustomColors(migrateTextAlign(attributes)),
  save({
    attributes
  }) {
    const {
      align,
      content,
      customTextColor,
      level,
      textColor
    } = attributes;
    const tagName = 'h' + level;
    const textClass = (0, _blockEditor.getColorClassName)('color', textColor);
    const className = (0, _classnames.default)({
      [textClass]: textClass,
      [`has-text-align-${align}`]: align
    });
    return (0, _react.createElement)(_blockEditor.RichText.Content, {
      className: className ? className : undefined,
      tagName: tagName,
      style: {
        color: textClass ? undefined : customTextColor
      },
      value: content
    });
  },
  supports: blockSupports
};
const v3 = {
  supports: blockSupports,
  attributes: {
    ...blockAttributes,
    customTextColor: {
      type: 'string'
    },
    textColor: {
      type: 'string'
    }
  },
  migrate: attributes => migrateCustomColors(migrateTextAlign(attributes)),
  save({
    attributes
  }) {
    const {
      align,
      content,
      customTextColor,
      level,
      textColor
    } = attributes;
    const tagName = 'h' + level;
    const textClass = (0, _blockEditor.getColorClassName)('color', textColor);
    const className = (0, _classnames.default)({
      [textClass]: textClass,
      'has-text-color': textColor || customTextColor,
      [`has-text-align-${align}`]: align
    });
    return (0, _react.createElement)(_blockEditor.RichText.Content, {
      className: className ? className : undefined,
      tagName: tagName,
      style: {
        color: textClass ? undefined : customTextColor
      },
      value: content
    });
  }
};
const v4 = {
  supports: {
    align: ['wide', 'full'],
    anchor: true,
    className: false,
    color: {
      link: true
    },
    fontSize: true,
    lineHeight: true,
    __experimentalSelector: {
      'core/heading/h1': 'h1',
      'core/heading/h2': 'h2',
      'core/heading/h3': 'h3',
      'core/heading/h4': 'h4',
      'core/heading/h5': 'h5',
      'core/heading/h6': 'h6'
    },
    __unstablePasteTextInline: true
  },
  attributes: blockAttributes,
  isEligible: ({
    align
  }) => TEXT_ALIGN_OPTIONS.includes(align),
  migrate: migrateTextAlign,
  save({
    attributes
  }) {
    const {
      align,
      content,
      level
    } = attributes;
    const TagName = 'h' + level;
    const className = (0, _classnames.default)({
      [`has-text-align-${align}`]: align
    });
    return (0, _react.createElement)(TagName, {
      ..._blockEditor.useBlockProps.save({
        className
      })
    }, (0, _react.createElement)(_blockEditor.RichText.Content, {
      value: content
    }));
  }
};

// This deprecation covers the serialization of the `wp-block-heading` class
// into the block's markup after className support was enabled.
const v5 = {
  supports: {
    align: ['wide', 'full'],
    anchor: true,
    className: false,
    color: {
      gradients: true,
      link: true,
      __experimentalDefaultControls: {
        background: true,
        text: true
      }
    },
    spacing: {
      margin: true,
      padding: true
    },
    typography: {
      fontSize: true,
      lineHeight: true,
      __experimentalFontFamily: true,
      __experimentalFontStyle: true,
      __experimentalFontWeight: true,
      __experimentalLetterSpacing: true,
      __experimentalTextTransform: true,
      __experimentalTextDecoration: true,
      __experimentalDefaultControls: {
        fontSize: true,
        fontAppearance: true,
        textTransform: true
      }
    },
    __experimentalSelector: 'h1,h2,h3,h4,h5,h6',
    __unstablePasteTextInline: true,
    __experimentalSlashInserter: true
  },
  attributes: {
    textAlign: {
      type: 'string'
    },
    content: {
      type: 'string',
      source: 'html',
      selector: 'h1,h2,h3,h4,h5,h6',
      default: '',
      __experimentalRole: 'content'
    },
    level: {
      type: 'number',
      default: 2
    },
    placeholder: {
      type: 'string'
    }
  },
  save({
    attributes
  }) {
    const {
      textAlign,
      content,
      level
    } = attributes;
    const TagName = 'h' + level;
    const className = (0, _classnames.default)({
      [`has-text-align-${textAlign}`]: textAlign
    });
    return (0, _react.createElement)(TagName, {
      ..._blockEditor.useBlockProps.save({
        className
      })
    }, (0, _react.createElement)(_blockEditor.RichText.Content, {
      value: content
    }));
  }
};
const deprecated = [v5, v4, v3, v2, v1];
var _default = exports.default = deprecated;
//# sourceMappingURL=deprecated.js.map