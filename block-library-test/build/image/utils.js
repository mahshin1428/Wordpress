"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.evalAspectRatio = evalAspectRatio;
exports.getImageSizeAttributes = getImageSizeAttributes;
exports.getUpdatedLinkTargetSettings = getUpdatedLinkTargetSettings;
exports.removeNewTabRel = removeNewTabRel;
var _constants = require("./constants");
/**
 * Internal dependencies
 */

/**
 * Evaluates a CSS aspect-ratio property value as a number.
 *
 * Degenerate or invalid ratios behave as 'auto'. And 'auto' ratios return NaN.
 *
 * @see https://drafts.csswg.org/css-sizing-4/#aspect-ratio
 *
 * @param {string} value CSS aspect-ratio property value.
 * @return {number} Numerical aspect ratio or NaN if invalid.
 */
function evalAspectRatio(value) {
  const [width, height = 1] = value.split('/').map(Number);
  const aspectRatio = width / height;
  return aspectRatio === Infinity || aspectRatio === 0 ? NaN : aspectRatio;
}
function removeNewTabRel(currentRel) {
  let newRel = currentRel;
  if (currentRel !== undefined && newRel) {
    _constants.NEW_TAB_REL.forEach(relVal => {
      const regExp = new RegExp('\\b' + relVal + '\\b', 'gi');
      newRel = newRel.replace(regExp, '');
    });

    // Only trim if NEW_TAB_REL values was replaced.
    if (newRel !== currentRel) {
      newRel = newRel.trim();
    }
    if (!newRel) {
      newRel = undefined;
    }
  }
  return newRel;
}

/**
 * Helper to get the link target settings to be stored.
 *
 * @param {boolean} value          The new link target value.
 * @param {Object}  attributes     Block attributes.
 * @param {Object}  attributes.rel Image block's rel attribute.
 *
 * @return {Object} Updated link target settings.
 */
function getUpdatedLinkTargetSettings(value, {
  rel
}) {
  const linkTarget = value ? '_blank' : undefined;
  let updatedRel;
  if (!linkTarget && !rel) {
    updatedRel = undefined;
  } else {
    updatedRel = removeNewTabRel(rel);
  }
  return {
    linkTarget,
    rel: updatedRel
  };
}

/**
 * Determines new Image block attributes size selection.
 *
 * @param {Object} image Media file object for gallery image.
 * @param {string} size  Selected size slug to apply.
 */
function getImageSizeAttributes(image, size) {
  const url = image?.media_details?.sizes?.[size]?.source_url;
  if (url) {
    return {
      url,
      width: undefined,
      height: undefined,
      sizeSlug: size
    };
  }
  return {};
}
//# sourceMappingURL=utils.js.map