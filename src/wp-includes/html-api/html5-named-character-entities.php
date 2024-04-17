<?php

// phpcs:disable

global $html5_named_character_entity_set;

/**
 * Set of named character references in the HTML5 specification.
 *
 * This list will never change, according to the spec. Each named
 * character reference is case-sensitive and the presence or absence
 * of the semicolon is significant. Without the semicolon, the rules
 * for an ambiguous ampersand govern whether the following text is
 * to be interpreted as a character reference or not.
 *
 * @link https://html.spec.whatwg.org/entities.json.
 */
$html5_named_character_entity_set = WP_Token_Map::from_precomputed_table(
	2,
	array(
		// AElig;[Æ] AElig[Æ].
		'AE' => "\x04lig;\x02Æ\x03lig\x02Æ",
		// AMP;[&] AMP[&].
		'AM' => "\x02P;\x01&\x01P\x01&",
		// Aacute;[Á] Aacute[Á].
		'Aa' => "\x05cute;\x02Á\x04cute\x02Á",
		// Abreve;[Ă].
		'Ab' => "\x05reve;\x02Ă",
		// Acirc;[Â] Acirc[Â] Acy;[А].
		'Ac' => "\x04irc;\x02Â\x03irc\x02Â\x02y;\x02А",
		// Afr;[𝔄].
		'Af' => "\x02r;\x04𝔄",
		// Agrave;[À] Agrave[À].
		'Ag' => "\x05rave;\x02À\x04rave\x02À",
		// Alpha;[Α].
		'Al' => "\x04pha;\x02Α",
		// Amacr;[Ā].
		'Am' => "\x04acr;\x02Ā",
		// And;[⩓].
		'An' => "\x02d;\x03⩓",
		// Aogon;[Ą] Aopf;[𝔸].
		'Ao' => "\x04gon;\x02Ą\x03pf;\x04𝔸",
		// ApplyFunction;[⁡].
		'Ap' => "\x0cplyFunction;\x03⁡",
		// Aring;[Å] Aring[Å].
		'Ar' => "\x04ing;\x02Å\x03ing\x02Å",
		// Assign;[≔] Ascr;[𝒜].
		'As' => "\x05sign;\x03≔\x03cr;\x04𝒜",
		// Atilde;[Ã] Atilde[Ã].
		'At' => "\x05ilde;\x02Ã\x04ilde\x02Ã",
		// Auml;[Ä] Auml[Ä].
		'Au' => "\x03ml;\x02Ä\x02ml\x02Ä",
		// Backslash;[∖] Barwed;[⌆] Barv;[⫧].
		'Ba' => "\x08ckslash;\x03∖\x05rwed;\x03⌆\x03rv;\x03⫧",
		// Bcy;[Б].
		'Bc' => "\x02y;\x02Б",
		// Bernoullis;[ℬ] Because;[∵] Beta;[Β].
		'Be' => "\x09rnoullis;\x03ℬ\x06cause;\x03∵\x03ta;\x02Β",
		// Bfr;[𝔅].
		'Bf' => "\x02r;\x04𝔅",
		// Bopf;[𝔹].
		'Bo' => "\x03pf;\x04𝔹",
		// Breve;[˘].
		'Br' => "\x04eve;\x02˘",
		// Bscr;[ℬ].
		'Bs' => "\x03cr;\x03ℬ",
		// Bumpeq;[≎].
		'Bu' => "\x05mpeq;\x03≎",
		// CHcy;[Ч].
		'CH' => "\x03cy;\x02Ч",
		// COPY;[©] COPY[©].
		'CO' => "\x03PY;\x02©\x02PY\x02©",
		// CapitalDifferentialD;[ⅅ] Cayleys;[ℭ] Cacute;[Ć] Cap;[⋒].
		'Ca' => "\x13pitalDifferentialD;\x03ⅅ\x06yleys;\x03ℭ\x05cute;\x02Ć\x02p;\x03⋒",
		// Cconint;[∰] Ccaron;[Č] Ccedil;[Ç] Ccedil[Ç] Ccirc;[Ĉ].
		'Cc' => "\x06onint;\x03∰\x05aron;\x02Č\x05edil;\x02Ç\x04edil\x02Ç\x04irc;\x02Ĉ",
		// Cdot;[Ċ].
		'Cd' => "\x03ot;\x02Ċ",
		// CenterDot;[·] Cedilla;[¸].
		'Ce' => "\x08nterDot;\x02·\x06dilla;\x02¸",
		// Cfr;[ℭ].
		'Cf' => "\x02r;\x03ℭ",
		// Chi;[Χ].
		'Ch' => "\x02i;\x02Χ",
		// CircleMinus;[⊖] CircleTimes;[⊗] CirclePlus;[⊕] CircleDot;[⊙].
		'Ci' => "\x0arcleMinus;\x03⊖\x0arcleTimes;\x03⊗\x09rclePlus;\x03⊕\x08rcleDot;\x03⊙",
		// ClockwiseContourIntegral;[∲] CloseCurlyDoubleQuote;[”] CloseCurlyQuote;[’].
		'Cl' => "\x17ockwiseContourIntegral;\x03∲\x14oseCurlyDoubleQuote;\x03”\x0eoseCurlyQuote;\x03’",
		// CounterClockwiseContourIntegral;[∳] ContourIntegral;[∮] Congruent;[≡] Coproduct;[∐] Colone;[⩴] Conint;[∯] Colon;[∷] Copf;[ℂ].
		'Co' => "\x1eunterClockwiseContourIntegral;\x03∳\x0entourIntegral;\x03∮\x08ngruent;\x03≡\x08product;\x03∐\x05lone;\x03⩴\x05nint;\x03∯\x04lon;\x03∷\x03pf;\x03ℂ",
		// Cross;[⨯].
		'Cr' => "\x04oss;\x03⨯",
		// Cscr;[𝒞].
		'Cs' => "\x03cr;\x04𝒞",
		// CupCap;[≍] Cup;[⋓].
		'Cu' => "\x05pCap;\x03≍\x02p;\x03⋓",
		// DDotrahd;[⤑] DD;[ⅅ].
		'DD' => "\x07otrahd;\x03⤑\x01;\x03ⅅ",
		// DJcy;[Ђ].
		'DJ' => "\x03cy;\x02Ђ",
		// DScy;[Ѕ].
		'DS' => "\x03cy;\x02Ѕ",
		// DZcy;[Џ].
		'DZ' => "\x03cy;\x02Џ",
		// Dagger;[‡] Dashv;[⫤] Darr;[↡].
		'Da' => "\x05gger;\x03‡\x04shv;\x03⫤\x03rr;\x03↡",
		// Dcaron;[Ď] Dcy;[Д].
		'Dc' => "\x05aron;\x02Ď\x02y;\x02Д",
		// Delta;[Δ] Del;[∇].
		'De' => "\x04lta;\x02Δ\x02l;\x03∇",
		// Dfr;[𝔇].
		'Df' => "\x02r;\x04𝔇",
		// DiacriticalDoubleAcute;[˝] DiacriticalAcute;[´] DiacriticalGrave;[`] DiacriticalTilde;[˜] DiacriticalDot;[˙] DifferentialD;[ⅆ] Diamond;[⋄].
		'Di' => "\x15acriticalDoubleAcute;\x02˝\x0facriticalAcute;\x02´\x0facriticalGrave;\x01`\x0facriticalTilde;\x02˜\x0dacriticalDot;\x02˙\x0cfferentialD;\x03ⅆ\x06amond;\x03⋄",
		// DoubleLongLeftRightArrow;[⟺] DoubleContourIntegral;[∯] DoubleLeftRightArrow;[⇔] DoubleLongRightArrow;[⟹] DoubleLongLeftArrow;[⟸] DownLeftRightVector;[⥐] DownRightTeeVector;[⥟] DownRightVectorBar;[⥗] DoubleUpDownArrow;[⇕] DoubleVerticalBar;[∥] DownLeftTeeVector;[⥞] DownLeftVectorBar;[⥖] DoubleRightArrow;[⇒] DownArrowUpArrow;[⇵] DoubleDownArrow;[⇓] DoubleLeftArrow;[⇐] DownRightVector;[⇁] DoubleRightTee;[⊨] DownLeftVector;[↽] DoubleLeftTee;[⫤] DoubleUpArrow;[⇑] DownArrowBar;[⤓] DownTeeArrow;[↧] DoubleDot;[¨] DownArrow;[↓] DownBreve;[̑] Downarrow;[⇓] DotEqual;[≐] DownTee;[⊤] DotDot;[⃜] Dopf;[𝔻] Dot;[¨].
		'Do' => "\x17ubleLongLeftRightArrow;\x03⟺\x14ubleContourIntegral;\x03∯\x13ubleLeftRightArrow;\x03⇔\x13ubleLongRightArrow;\x03⟹\x12ubleLongLeftArrow;\x03⟸\x12wnLeftRightVector;\x03⥐\x11wnRightTeeVector;\x03⥟\x11wnRightVectorBar;\x03⥗\x10ubleUpDownArrow;\x03⇕\x10ubleVerticalBar;\x03∥\x10wnLeftTeeVector;\x03⥞\x10wnLeftVectorBar;\x03⥖\x0fubleRightArrow;\x03⇒\x0fwnArrowUpArrow;\x03⇵\x0eubleDownArrow;\x03⇓\x0eubleLeftArrow;\x03⇐\x0ewnRightVector;\x03⇁\x0dubleRightTee;\x03⊨\x0dwnLeftVector;\x03↽\x0cubleLeftTee;\x03⫤\x0cubleUpArrow;\x03⇑\x0bwnArrowBar;\x03⤓\x0bwnTeeArrow;\x03↧\x08ubleDot;\x02¨\x08wnArrow;\x03↓\x08wnBreve;\x02̑\x08wnarrow;\x03⇓\x07tEqual;\x03≐\x06wnTee;\x03⊤\x05tDot;\x03⃜\x03pf;\x04𝔻\x02t;\x02¨",
		// Dstrok;[Đ] Dscr;[𝒟].
		'Ds' => "\x05trok;\x02Đ\x03cr;\x04𝒟",
		// ENG;[Ŋ].
		'EN' => "\x02G;\x02Ŋ",
		// ETH;[Ð] ETH[Ð].
		'ET' => "\x02H;\x02Ð\x01H\x02Ð",
		// Eacute;[É] Eacute[É].
		'Ea' => "\x05cute;\x02É\x04cute\x02É",
		// Ecaron;[Ě] Ecirc;[Ê] Ecirc[Ê] Ecy;[Э].
		'Ec' => "\x05aron;\x02Ě\x04irc;\x02Ê\x03irc\x02Ê\x02y;\x02Э",
		// Edot;[Ė].
		'Ed' => "\x03ot;\x02Ė",
		// Efr;[𝔈].
		'Ef' => "\x02r;\x04𝔈",
		// Egrave;[È] Egrave[È].
		'Eg' => "\x05rave;\x02È\x04rave\x02È",
		// Element;[∈].
		'El' => "\x06ement;\x03∈",
		// EmptyVerySmallSquare;[▫] EmptySmallSquare;[◻] Emacr;[Ē].
		'Em' => "\x13ptyVerySmallSquare;\x03▫\x0fptySmallSquare;\x03◻\x04acr;\x02Ē",
		// Eogon;[Ę] Eopf;[𝔼].
		'Eo' => "\x04gon;\x02Ę\x03pf;\x04𝔼",
		// Epsilon;[Ε].
		'Ep' => "\x06silon;\x02Ε",
		// Equilibrium;[⇌] EqualTilde;[≂] Equal;[⩵].
		'Eq' => "\x0auilibrium;\x03⇌\x09ualTilde;\x03≂\x04ual;\x03⩵",
		// Escr;[ℰ] Esim;[⩳].
		'Es' => "\x03cr;\x03ℰ\x03im;\x03⩳",
		// Eta;[Η].
		'Et' => "\x02a;\x02Η",
		// Euml;[Ë] Euml[Ë].
		'Eu' => "\x03ml;\x02Ë\x02ml\x02Ë",
		// ExponentialE;[ⅇ] Exists;[∃].
		'Ex' => "\x0bponentialE;\x03ⅇ\x05ists;\x03∃",
		// Fcy;[Ф].
		'Fc' => "\x02y;\x02Ф",
		// Ffr;[𝔉].
		'Ff' => "\x02r;\x04𝔉",
		// FilledVerySmallSquare;[▪] FilledSmallSquare;[◼].
		'Fi' => "\x14lledVerySmallSquare;\x03▪\x10lledSmallSquare;\x03◼",
		// Fouriertrf;[ℱ] ForAll;[∀] Fopf;[𝔽].
		'Fo' => "\x09uriertrf;\x03ℱ\x05rAll;\x03∀\x03pf;\x04𝔽",
		// Fscr;[ℱ].
		'Fs' => "\x03cr;\x03ℱ",
		// GJcy;[Ѓ].
		'GJ' => "\x03cy;\x02Ѓ",
		// GT;[>].
		'GT' => "\x01;\x01>",
		// Gammad;[Ϝ] Gamma;[Γ].
		'Ga' => "\x05mmad;\x02Ϝ\x04mma;\x02Γ",
		// Gbreve;[Ğ].
		'Gb' => "\x05reve;\x02Ğ",
		// Gcedil;[Ģ] Gcirc;[Ĝ] Gcy;[Г].
		'Gc' => "\x05edil;\x02Ģ\x04irc;\x02Ĝ\x02y;\x02Г",
		// Gdot;[Ġ].
		'Gd' => "\x03ot;\x02Ġ",
		// Gfr;[𝔊].
		'Gf' => "\x02r;\x04𝔊",
		// Gg;[⋙].
		'Gg' => "\x01;\x03⋙",
		// Gopf;[𝔾].
		'Go' => "\x03pf;\x04𝔾",
		// GreaterSlantEqual;[⩾] GreaterEqualLess;[⋛] GreaterFullEqual;[≧] GreaterGreater;[⪢] GreaterEqual;[≥] GreaterTilde;[≳] GreaterLess;[≷].
		'Gr' => "\x10eaterSlantEqual;\x03⩾\x0featerEqualLess;\x03⋛\x0featerFullEqual;\x03≧\x0deaterGreater;\x03⪢\x0beaterEqual;\x03≥\x0beaterTilde;\x03≳\x0aeaterLess;\x03≷",
		// Gscr;[𝒢].
		'Gs' => "\x03cr;\x04𝒢",
		// Gt;[≫].
		'Gt' => "\x01;\x03≫",
		// HARDcy;[Ъ].
		'HA' => "\x05RDcy;\x02Ъ",
		// Hacek;[ˇ] Hat;[^].
		'Ha' => "\x04cek;\x02ˇ\x02t;\x01^",
		// Hcirc;[Ĥ].
		'Hc' => "\x04irc;\x02Ĥ",
		// Hfr;[ℌ].
		'Hf' => "\x02r;\x03ℌ",
		// HilbertSpace;[ℋ].
		'Hi' => "\x0blbertSpace;\x03ℋ",
		// HorizontalLine;[─] Hopf;[ℍ].
		'Ho' => "\x0drizontalLine;\x03─\x03pf;\x03ℍ",
		// Hstrok;[Ħ] Hscr;[ℋ].
		'Hs' => "\x05trok;\x02Ħ\x03cr;\x03ℋ",
		// HumpDownHump;[≎] HumpEqual;[≏].
		'Hu' => "\x0bmpDownHump;\x03≎\x08mpEqual;\x03≏",
		// IEcy;[Е].
		'IE' => "\x03cy;\x02Е",
		// IJlig;[Ĳ].
		'IJ' => "\x04lig;\x02Ĳ",
		// IOcy;[Ё].
		'IO' => "\x03cy;\x02Ё",
		// Iacute;[Í] Iacute[Í].
		'Ia' => "\x05cute;\x02Í\x04cute\x02Í",
		// Icirc;[Î] Icirc[Î] Icy;[И].
		'Ic' => "\x04irc;\x02Î\x03irc\x02Î\x02y;\x02И",
		// Idot;[İ].
		'Id' => "\x03ot;\x02İ",
		// Ifr;[ℑ].
		'If' => "\x02r;\x03ℑ",
		// Igrave;[Ì] Igrave[Ì].
		'Ig' => "\x05rave;\x02Ì\x04rave\x02Ì",
		// ImaginaryI;[ⅈ] Implies;[⇒] Imacr;[Ī] Im;[ℑ].
		'Im' => "\x09aginaryI;\x03ⅈ\x06plies;\x03⇒\x04acr;\x02Ī\x01;\x03ℑ",
		// InvisibleComma;[⁣] InvisibleTimes;[⁢] Intersection;[⋂] Integral;[∫] Int;[∬].
		'In' => "\x0dvisibleComma;\x03⁣\x0dvisibleTimes;\x03⁢\x0btersection;\x03⋂\x07tegral;\x03∫\x02t;\x03∬",
		// Iogon;[Į] Iopf;[𝕀] Iota;[Ι].
		'Io' => "\x04gon;\x02Į\x03pf;\x04𝕀\x03ta;\x02Ι",
		// Iscr;[ℐ].
		'Is' => "\x03cr;\x03ℐ",
		// Itilde;[Ĩ].
		'It' => "\x05ilde;\x02Ĩ",
		// Iukcy;[І] Iuml;[Ï] Iuml[Ï].
		'Iu' => "\x04kcy;\x02І\x03ml;\x02Ï\x02ml\x02Ï",
		// Jcirc;[Ĵ] Jcy;[Й].
		'Jc' => "\x04irc;\x02Ĵ\x02y;\x02Й",
		// Jfr;[𝔍].
		'Jf' => "\x02r;\x04𝔍",
		// Jopf;[𝕁].
		'Jo' => "\x03pf;\x04𝕁",
		// Jsercy;[Ј] Jscr;[𝒥].
		'Js' => "\x05ercy;\x02Ј\x03cr;\x04𝒥",
		// Jukcy;[Є].
		'Ju' => "\x04kcy;\x02Є",
		// KHcy;[Х].
		'KH' => "\x03cy;\x02Х",
		// KJcy;[Ќ].
		'KJ' => "\x03cy;\x02Ќ",
		// Kappa;[Κ].
		'Ka' => "\x04ppa;\x02Κ",
		// Kcedil;[Ķ] Kcy;[К].
		'Kc' => "\x05edil;\x02Ķ\x02y;\x02К",
		// Kfr;[𝔎].
		'Kf' => "\x02r;\x04𝔎",
		// Kopf;[𝕂].
		'Ko' => "\x03pf;\x04𝕂",
		// Kscr;[𝒦].
		'Ks' => "\x03cr;\x04𝒦",
		// LJcy;[Љ].
		'LJ' => "\x03cy;\x02Љ",
		// LT;[<].
		'LT' => "\x01;\x01<",
		// Laplacetrf;[ℒ] Lacute;[Ĺ] Lambda;[Λ] Lang;[⟪] Larr;[↞].
		'La' => "\x09placetrf;\x03ℒ\x05cute;\x02Ĺ\x05mbda;\x02Λ\x03ng;\x03⟪\x03rr;\x03↞",
		// Lcaron;[Ľ] Lcedil;[Ļ] Lcy;[Л].
		'Lc' => "\x05aron;\x02Ľ\x05edil;\x02Ļ\x02y;\x02Л",
		// LeftArrowRightArrow;[⇆] LeftDoubleBracket;[⟦] LeftDownTeeVector;[⥡] LeftDownVectorBar;[⥙] LeftTriangleEqual;[⊴] LeftAngleBracket;[⟨] LeftUpDownVector;[⥑] LessEqualGreater;[⋚] LeftRightVector;[⥎] LeftTriangleBar;[⧏] LeftUpTeeVector;[⥠] LeftUpVectorBar;[⥘] LeftDownVector;[⇃] LeftRightArrow;[↔] Leftrightarrow;[⇔] LessSlantEqual;[⩽] LeftTeeVector;[⥚] LeftVectorBar;[⥒] LessFullEqual;[≦] LeftArrowBar;[⇤] LeftTeeArrow;[↤] LeftTriangle;[⊲] LeftUpVector;[↿] LeftCeiling;[⌈] LessGreater;[≶] LeftVector;[↼] LeftArrow;[←] LeftFloor;[⌊] Leftarrow;[⇐] LessTilde;[≲] LessLess;[⪡] LeftTee;[⊣].
		'Le' => "\x12ftArrowRightArrow;\x03⇆\x10ftDoubleBracket;\x03⟦\x10ftDownTeeVector;\x03⥡\x10ftDownVectorBar;\x03⥙\x10ftTriangleEqual;\x03⊴\x0fftAngleBracket;\x03⟨\x0fftUpDownVector;\x03⥑\x0fssEqualGreater;\x03⋚\x0eftRightVector;\x03⥎\x0eftTriangleBar;\x03⧏\x0eftUpTeeVector;\x03⥠\x0eftUpVectorBar;\x03⥘\x0dftDownVector;\x03⇃\x0dftRightArrow;\x03↔\x0dftrightarrow;\x03⇔\x0dssSlantEqual;\x03⩽\x0cftTeeVector;\x03⥚\x0cftVectorBar;\x03⥒\x0cssFullEqual;\x03≦\x0bftArrowBar;\x03⇤\x0bftTeeArrow;\x03↤\x0bftTriangle;\x03⊲\x0bftUpVector;\x03↿\x0aftCeiling;\x03⌈\x0assGreater;\x03≶\x09ftVector;\x03↼\x08ftArrow;\x03←\x08ftFloor;\x03⌊\x08ftarrow;\x03⇐\x08ssTilde;\x03≲\x07ssLess;\x03⪡\x06ftTee;\x03⊣",
		// Lfr;[𝔏].
		'Lf' => "\x02r;\x04𝔏",
		// Lleftarrow;[⇚] Ll;[⋘].
		'Ll' => "\x09eftarrow;\x03⇚\x01;\x03⋘",
		// Lmidot;[Ŀ].
		'Lm' => "\x05idot;\x02Ŀ",
		// LongLeftRightArrow;[⟷] Longleftrightarrow;[⟺] LowerRightArrow;[↘] LongRightArrow;[⟶] Longrightarrow;[⟹] LowerLeftArrow;[↙] LongLeftArrow;[⟵] Longleftarrow;[⟸] Lopf;[𝕃].
		'Lo' => "\x11ngLeftRightArrow;\x03⟷\x11ngleftrightarrow;\x03⟺\x0ewerRightArrow;\x03↘\x0dngRightArrow;\x03⟶\x0dngrightarrow;\x03⟹\x0dwerLeftArrow;\x03↙\x0cngLeftArrow;\x03⟵\x0cngleftarrow;\x03⟸\x03pf;\x04𝕃",
		// Lstrok;[Ł] Lscr;[ℒ] Lsh;[↰].
		'Ls' => "\x05trok;\x02Ł\x03cr;\x03ℒ\x02h;\x03↰",
		// Lt;[≪].
		'Lt' => "\x01;\x03≪",
		// Map;[⤅].
		'Ma' => "\x02p;\x03⤅",
		// Mcy;[М].
		'Mc' => "\x02y;\x02М",
		// MediumSpace;[ ] Mellintrf;[ℳ].
		'Me' => "\x0adiumSpace;\x03 \x08llintrf;\x03ℳ",
		// Mfr;[𝔐].
		'Mf' => "\x02r;\x04𝔐",
		// MinusPlus;[∓].
		'Mi' => "\x08nusPlus;\x03∓",
		// Mopf;[𝕄].
		'Mo' => "\x03pf;\x04𝕄",
		// Mscr;[ℳ].
		'Ms' => "\x03cr;\x03ℳ",
		// Mu;[Μ].
		'Mu' => "\x01;\x02Μ",
		// NJcy;[Њ].
		'NJ' => "\x03cy;\x02Њ",
		// Nacute;[Ń].
		'Na' => "\x05cute;\x02Ń",
		// Ncaron;[Ň] Ncedil;[Ņ] Ncy;[Н].
		'Nc' => "\x05aron;\x02Ň\x05edil;\x02Ņ\x02y;\x02Н",
		// NegativeVeryThinSpace;[​] NestedGreaterGreater;[≫] NegativeMediumSpace;[​] NegativeThickSpace;[​] NegativeThinSpace;[​] NestedLessLess;[≪] NewLine;[\xa].
		'Ne' => "\x14gativeVeryThinSpace;\x03​\x13stedGreaterGreater;\x03≫\x12gativeMediumSpace;\x03​\x11gativeThickSpace;\x03​\x10gativeThinSpace;\x03​\x0dstedLessLess;\x03≪\x06wLine;\x01\xa",
		// Nfr;[𝔑].
		'Nf' => "\x02r;\x04𝔑",
		// NotNestedGreaterGreater;[⪢̸] NotSquareSupersetEqual;[⋣] NotPrecedesSlantEqual;[⋠] NotRightTriangleEqual;[⋭] NotSucceedsSlantEqual;[⋡] NotDoubleVerticalBar;[∦] NotGreaterSlantEqual;[⩾̸] NotLeftTriangleEqual;[⋬] NotSquareSubsetEqual;[⋢] NotGreaterFullEqual;[≧̸] NotRightTriangleBar;[⧐̸] NotLeftTriangleBar;[⧏̸] NotGreaterGreater;[≫̸] NotLessSlantEqual;[⩽̸] NotNestedLessLess;[⪡̸] NotReverseElement;[∌] NotSquareSuperset;[⊐̸] NotTildeFullEqual;[≇] NonBreakingSpace;[ ] NotPrecedesEqual;[⪯̸] NotRightTriangle;[⋫] NotSucceedsEqual;[⪰̸] NotSucceedsTilde;[≿̸] NotSupersetEqual;[⊉] NotGreaterEqual;[≱] NotGreaterTilde;[≵] NotHumpDownHump;[≎̸] NotLeftTriangle;[⋪] NotSquareSubset;[⊏̸] NotGreaterLess;[≹] NotLessGreater;[≸] NotSubsetEqual;[⊈] NotVerticalBar;[∤] NotEqualTilde;[≂̸] NotTildeEqual;[≄] NotTildeTilde;[≉] NotCongruent;[≢] NotHumpEqual;[≏̸] NotLessEqual;[≰] NotLessTilde;[≴] NotLessLess;[≪̸] NotPrecedes;[⊀] NotSucceeds;[⊁] NotSuperset;[⊃⃒] NotElement;[∉] NotGreater;[≯] NotCupCap;[≭] NotExists;[∄] NotSubset;[⊂⃒] NotEqual;[≠] NotTilde;[≁] NoBreak;[⁠] NotLess;[≮] Nopf;[ℕ] Not;[⫬].
		'No' => "\x16tNestedGreaterGreater;\x05⪢̸\x15tSquareSupersetEqual;\x03⋣\x14tPrecedesSlantEqual;\x03⋠\x14tRightTriangleEqual;\x03⋭\x14tSucceedsSlantEqual;\x03⋡\x13tDoubleVerticalBar;\x03∦\x13tGreaterSlantEqual;\x05⩾̸\x13tLeftTriangleEqual;\x03⋬\x13tSquareSubsetEqual;\x03⋢\x12tGreaterFullEqual;\x05≧̸\x12tRightTriangleBar;\x05⧐̸\x11tLeftTriangleBar;\x05⧏̸\x10tGreaterGreater;\x05≫̸\x10tLessSlantEqual;\x05⩽̸\x10tNestedLessLess;\x05⪡̸\x10tReverseElement;\x03∌\x10tSquareSuperset;\x05⊐̸\x10tTildeFullEqual;\x03≇\x0fnBreakingSpace;\x02 \x0ftPrecedesEqual;\x05⪯̸\x0ftRightTriangle;\x03⋫\x0ftSucceedsEqual;\x05⪰̸\x0ftSucceedsTilde;\x05≿̸\x0ftSupersetEqual;\x03⊉\x0etGreaterEqual;\x03≱\x0etGreaterTilde;\x03≵\x0etHumpDownHump;\x05≎̸\x0etLeftTriangle;\x03⋪\x0etSquareSubset;\x05⊏̸\x0dtGreaterLess;\x03≹\x0dtLessGreater;\x03≸\x0dtSubsetEqual;\x03⊈\x0dtVerticalBar;\x03∤\x0ctEqualTilde;\x05≂̸\x0ctTildeEqual;\x03≄\x0ctTildeTilde;\x03≉\x0btCongruent;\x03≢\x0btHumpEqual;\x05≏̸\x0btLessEqual;\x03≰\x0btLessTilde;\x03≴\x0atLessLess;\x05≪̸\x0atPrecedes;\x03⊀\x0atSucceeds;\x03⊁\x0atSuperset;\x06⊃⃒\x09tElement;\x03∉\x09tGreater;\x03≯\x08tCupCap;\x03≭\x08tExists;\x03∄\x08tSubset;\x06⊂⃒\x07tEqual;\x03≠\x07tTilde;\x03≁\x06Break;\x03⁠\x06tLess;\x03≮\x03pf;\x03ℕ\x02t;\x03⫬",
		// Nscr;[𝒩].
		'Ns' => "\x03cr;\x04𝒩",
		// Ntilde;[Ñ] Ntilde[Ñ].
		'Nt' => "\x05ilde;\x02Ñ\x04ilde\x02Ñ",
		// Nu;[Ν].
		'Nu' => "\x01;\x02Ν",
		// OElig;[Œ].
		'OE' => "\x04lig;\x02Œ",
		// Oacute;[Ó] Oacute[Ó].
		'Oa' => "\x05cute;\x02Ó\x04cute\x02Ó",
		// Ocirc;[Ô] Ocirc[Ô] Ocy;[О].
		'Oc' => "\x04irc;\x02Ô\x03irc\x02Ô\x02y;\x02О",
		// Odblac;[Ő].
		'Od' => "\x05blac;\x02Ő",
		// Ofr;[𝔒].
		'Of' => "\x02r;\x04𝔒",
		// Ograve;[Ò] Ograve[Ò].
		'Og' => "\x05rave;\x02Ò\x04rave\x02Ò",
		// Omicron;[Ο] Omacr;[Ō] Omega;[Ω].
		'Om' => "\x06icron;\x02Ο\x04acr;\x02Ō\x04ega;\x02Ω",
		// Oopf;[𝕆].
		'Oo' => "\x03pf;\x04𝕆",
		// OpenCurlyDoubleQuote;[“] OpenCurlyQuote;[‘].
		'Op' => "\x13enCurlyDoubleQuote;\x03“\x0denCurlyQuote;\x03‘",
		// Or;[⩔].
		'Or' => "\x01;\x03⩔",
		// Oslash;[Ø] Oslash[Ø] Oscr;[𝒪].
		'Os' => "\x05lash;\x02Ø\x04lash\x02Ø\x03cr;\x04𝒪",
		// Otilde;[Õ] Otimes;[⨷] Otilde[Õ].
		'Ot' => "\x05ilde;\x02Õ\x05imes;\x03⨷\x04ilde\x02Õ",
		// Ouml;[Ö] Ouml[Ö].
		'Ou' => "\x03ml;\x02Ö\x02ml\x02Ö",
		// OverParenthesis;[⏜] OverBracket;[⎴] OverBrace;[⏞] OverBar;[‾].
		'Ov' => "\x0eerParenthesis;\x03⏜\x0aerBracket;\x03⎴\x08erBrace;\x03⏞\x06erBar;\x03‾",
		// PartialD;[∂].
		'Pa' => "\x07rtialD;\x03∂",
		// Pcy;[П].
		'Pc' => "\x02y;\x02П",
		// Pfr;[𝔓].
		'Pf' => "\x02r;\x04𝔓",
		// Phi;[Φ].
		'Ph' => "\x02i;\x02Φ",
		// Pi;[Π].
		'Pi' => "\x01;\x02Π",
		// PlusMinus;[±].
		'Pl' => "\x08usMinus;\x02±",
		// Poincareplane;[ℌ] Popf;[ℙ].
		'Po' => "\x0cincareplane;\x03ℌ\x03pf;\x03ℙ",
		// PrecedesSlantEqual;[≼] PrecedesEqual;[⪯] PrecedesTilde;[≾] Proportional;[∝] Proportion;[∷] Precedes;[≺] Product;[∏] Prime;[″] Pr;[⪻].
		'Pr' => "\x11ecedesSlantEqual;\x03≼\x0cecedesEqual;\x03⪯\x0cecedesTilde;\x03≾\x0boportional;\x03∝\x09oportion;\x03∷\x07ecedes;\x03≺\x06oduct;\x03∏\x04ime;\x03″\x01;\x03⪻",
		// Pscr;[𝒫] Psi;[Ψ].
		'Ps' => "\x03cr;\x04𝒫\x02i;\x02Ψ",
		// QUOT;[\"] QUOT[\"].
		'QU' => "\x03OT;\x01\"\x02OT\x01\"",
		// Qfr;[𝔔].
		'Qf' => "\x02r;\x04𝔔",
		// Qopf;[ℚ].
		'Qo' => "\x03pf;\x03ℚ",
		// Qscr;[𝒬].
		'Qs' => "\x03cr;\x04𝒬",
		// RBarr;[⤐].
		'RB' => "\x04arr;\x03⤐",
		// REG;[®] REG[®].
		'RE' => "\x02G;\x02®\x01G\x02®",
		// Racute;[Ŕ] Rarrtl;[⤖] Rang;[⟫] Rarr;[↠].
		'Ra' => "\x05cute;\x02Ŕ\x05rrtl;\x03⤖\x03ng;\x03⟫\x03rr;\x03↠",
		// Rcaron;[Ř] Rcedil;[Ŗ] Rcy;[Р].
		'Rc' => "\x05aron;\x02Ř\x05edil;\x02Ŗ\x02y;\x02Р",
		// ReverseUpEquilibrium;[⥯] ReverseEquilibrium;[⇋] ReverseElement;[∋] Re;[ℜ].
		'Re' => "\x13verseUpEquilibrium;\x03⥯\x11verseEquilibrium;\x03⇋\x0dverseElement;\x03∋\x01;\x03ℜ",
		// Rfr;[ℜ].
		'Rf' => "\x02r;\x03ℜ",
		// Rho;[Ρ].
		'Rh' => "\x02o;\x02Ρ",
		// RightArrowLeftArrow;[⇄] RightDoubleBracket;[⟧] RightDownTeeVector;[⥝] RightDownVectorBar;[⥕] RightTriangleEqual;[⊵] RightAngleBracket;[⟩] RightUpDownVector;[⥏] RightTriangleBar;[⧐] RightUpTeeVector;[⥜] RightUpVectorBar;[⥔] RightDownVector;[⇂] RightTeeVector;[⥛] RightVectorBar;[⥓] RightArrowBar;[⇥] RightTeeArrow;[↦] RightTriangle;[⊳] RightUpVector;[↾] RightCeiling;[⌉] RightVector;[⇀] RightArrow;[→] RightFloor;[⌋] Rightarrow;[⇒] RightTee;[⊢].
		'Ri' => "\x12ghtArrowLeftArrow;\x03⇄\x11ghtDoubleBracket;\x03⟧\x11ghtDownTeeVector;\x03⥝\x11ghtDownVectorBar;\x03⥕\x11ghtTriangleEqual;\x03⊵\x10ghtAngleBracket;\x03⟩\x10ghtUpDownVector;\x03⥏\x0fghtTriangleBar;\x03⧐\x0fghtUpTeeVector;\x03⥜\x0fghtUpVectorBar;\x03⥔\x0eghtDownVector;\x03⇂\x0dghtTeeVector;\x03⥛\x0dghtVectorBar;\x03⥓\x0cghtArrowBar;\x03⇥\x0cghtTeeArrow;\x03↦\x0cghtTriangle;\x03⊳\x0cghtUpVector;\x03↾\x0bghtCeiling;\x03⌉\x0aghtVector;\x03⇀\x09ghtArrow;\x03→\x09ghtFloor;\x03⌋\x09ghtarrow;\x03⇒\x07ghtTee;\x03⊢",
		// RoundImplies;[⥰] Ropf;[ℝ].
		'Ro' => "\x0bundImplies;\x03⥰\x03pf;\x03ℝ",
		// Rrightarrow;[⇛].
		'Rr' => "\x0aightarrow;\x03⇛",
		// Rscr;[ℛ] Rsh;[↱].
		'Rs' => "\x03cr;\x03ℛ\x02h;\x03↱",
		// RuleDelayed;[⧴].
		'Ru' => "\x0aleDelayed;\x03⧴",
		// SHCHcy;[Щ] SHcy;[Ш].
		'SH' => "\x05CHcy;\x02Щ\x03cy;\x02Ш",
		// SOFTcy;[Ь].
		'SO' => "\x05FTcy;\x02Ь",
		// Sacute;[Ś].
		'Sa' => "\x05cute;\x02Ś",
		// Scaron;[Š] Scedil;[Ş] Scirc;[Ŝ] Scy;[С] Sc;[⪼].
		'Sc' => "\x05aron;\x02Š\x05edil;\x02Ş\x04irc;\x02Ŝ\x02y;\x02С\x01;\x03⪼",
		// Sfr;[𝔖].
		'Sf' => "\x02r;\x04𝔖",
		// ShortRightArrow;[→] ShortDownArrow;[↓] ShortLeftArrow;[←] ShortUpArrow;[↑].
		'Sh' => "\x0eortRightArrow;\x03→\x0dortDownArrow;\x03↓\x0dortLeftArrow;\x03←\x0bortUpArrow;\x03↑",
		// Sigma;[Σ].
		'Si' => "\x04gma;\x02Σ",
		// SmallCircle;[∘].
		'Sm' => "\x0aallCircle;\x03∘",
		// Sopf;[𝕊].
		'So' => "\x03pf;\x04𝕊",
		// SquareSupersetEqual;[⊒] SquareIntersection;[⊓] SquareSubsetEqual;[⊑] SquareSuperset;[⊐] SquareSubset;[⊏] SquareUnion;[⊔] Square;[□] Sqrt;[√].
		'Sq' => "\x12uareSupersetEqual;\x03⊒\x11uareIntersection;\x03⊓\x10uareSubsetEqual;\x03⊑\x0duareSuperset;\x03⊐\x0buareSubset;\x03⊏\x0auareUnion;\x03⊔\x05uare;\x03□\x03rt;\x03√",
		// Sscr;[𝒮].
		'Ss' => "\x03cr;\x04𝒮",
		// Star;[⋆].
		'St' => "\x03ar;\x03⋆",
		// SucceedsSlantEqual;[≽] SucceedsEqual;[⪰] SucceedsTilde;[≿] SupersetEqual;[⊇] SubsetEqual;[⊆] Succeeds;[≻] SuchThat;[∋] Superset;[⊃] Subset;[⋐] Supset;[⋑] Sub;[⋐] Sum;[∑] Sup;[⋑].
		'Su' => "\x11cceedsSlantEqual;\x03≽\x0ccceedsEqual;\x03⪰\x0ccceedsTilde;\x03≿\x0cpersetEqual;\x03⊇\x0absetEqual;\x03⊆\x07cceeds;\x03≻\x07chThat;\x03∋\x07perset;\x03⊃\x05bset;\x03⋐\x05pset;\x03⋑\x02b;\x03⋐\x02m;\x03∑\x02p;\x03⋑",
		// THORN;[Þ] THORN[Þ].
		'TH' => "\x04ORN;\x02Þ\x03ORN\x02Þ",
		// TRADE;[™].
		'TR' => "\x04ADE;\x03™",
		// TSHcy;[Ћ] TScy;[Ц].
		'TS' => "\x04Hcy;\x02Ћ\x03cy;\x02Ц",
		// Tab;[\x9] Tau;[Τ].
		'Ta' => "\x02b;\x01\x9\x02u;\x02Τ",
		// Tcaron;[Ť] Tcedil;[Ţ] Tcy;[Т].
		'Tc' => "\x05aron;\x02Ť\x05edil;\x02Ţ\x02y;\x02Т",
		// Tfr;[𝔗].
		'Tf' => "\x02r;\x04𝔗",
		// ThickSpace;[  ] Therefore;[∴] ThinSpace;[ ] Theta;[Θ].
		'Th' => "\x09ickSpace;\x06  \x08erefore;\x03∴\x08inSpace;\x03 \x04eta;\x02Θ",
		// TildeFullEqual;[≅] TildeEqual;[≃] TildeTilde;[≈] Tilde;[∼].
		'Ti' => "\x0dldeFullEqual;\x03≅\x09ldeEqual;\x03≃\x09ldeTilde;\x03≈\x04lde;\x03∼",
		// Topf;[𝕋].
		'To' => "\x03pf;\x04𝕋",
		// TripleDot;[⃛].
		'Tr' => "\x08ipleDot;\x03⃛",
		// Tstrok;[Ŧ] Tscr;[𝒯].
		'Ts' => "\x05trok;\x02Ŧ\x03cr;\x04𝒯",
		// Uarrocir;[⥉] Uacute;[Ú] Uacute[Ú] Uarr;[↟].
		'Ua' => "\x07rrocir;\x03⥉\x05cute;\x02Ú\x04cute\x02Ú\x03rr;\x03↟",
		// Ubreve;[Ŭ] Ubrcy;[Ў].
		'Ub' => "\x05reve;\x02Ŭ\x04rcy;\x02Ў",
		// Ucirc;[Û] Ucirc[Û] Ucy;[У].
		'Uc' => "\x04irc;\x02Û\x03irc\x02Û\x02y;\x02У",
		// Udblac;[Ű].
		'Ud' => "\x05blac;\x02Ű",
		// Ufr;[𝔘].
		'Uf' => "\x02r;\x04𝔘",
		// Ugrave;[Ù] Ugrave[Ù].
		'Ug' => "\x05rave;\x02Ù\x04rave\x02Ù",
		// Umacr;[Ū].
		'Um' => "\x04acr;\x02Ū",
		// UnderParenthesis;[⏝] UnderBracket;[⎵] UnderBrace;[⏟] UnionPlus;[⊎] UnderBar;[_] Union;[⋃].
		'Un' => "\x0fderParenthesis;\x03⏝\x0bderBracket;\x03⎵\x09derBrace;\x03⏟\x08ionPlus;\x03⊎\x07derBar;\x01_\x04ion;\x03⋃",
		// Uogon;[Ų] Uopf;[𝕌].
		'Uo' => "\x04gon;\x02Ų\x03pf;\x04𝕌",
		// UpArrowDownArrow;[⇅] UpperRightArrow;[↗] UpperLeftArrow;[↖] UpEquilibrium;[⥮] UpDownArrow;[↕] Updownarrow;[⇕] UpArrowBar;[⤒] UpTeeArrow;[↥] UpArrow;[↑] Uparrow;[⇑] Upsilon;[Υ] UpTee;[⊥] Upsi;[ϒ].
		'Up' => "\x0fArrowDownArrow;\x03⇅\x0eperRightArrow;\x03↗\x0dperLeftArrow;\x03↖\x0cEquilibrium;\x03⥮\x0aDownArrow;\x03↕\x0adownarrow;\x03⇕\x09ArrowBar;\x03⤒\x09TeeArrow;\x03↥\x06Arrow;\x03↑\x06arrow;\x03⇑\x06silon;\x02Υ\x04Tee;\x03⊥\x03si;\x02ϒ",
		// Uring;[Ů].
		'Ur' => "\x04ing;\x02Ů",
		// Uscr;[𝒰].
		'Us' => "\x03cr;\x04𝒰",
		// Utilde;[Ũ].
		'Ut' => "\x05ilde;\x02Ũ",
		// Uuml;[Ü] Uuml[Ü].
		'Uu' => "\x03ml;\x02Ü\x02ml\x02Ü",
		// VDash;[⊫].
		'VD' => "\x04ash;\x03⊫",
		// Vbar;[⫫].
		'Vb' => "\x03ar;\x03⫫",
		// Vcy;[В].
		'Vc' => "\x02y;\x02В",
		// Vdashl;[⫦] Vdash;[⊩].
		'Vd' => "\x05ashl;\x03⫦\x04ash;\x03⊩",
		// VerticalSeparator;[❘] VerticalTilde;[≀] VeryThinSpace;[ ] VerticalLine;[|] VerticalBar;[∣] Verbar;[‖] Vert;[‖] Vee;[⋁].
		'Ve' => "\x10rticalSeparator;\x03❘\x0crticalTilde;\x03≀\x0cryThinSpace;\x03 \x0brticalLine;\x01|\x0articalBar;\x03∣\x05rbar;\x03‖\x03rt;\x03‖\x02e;\x03⋁",
		// Vfr;[𝔙].
		'Vf' => "\x02r;\x04𝔙",
		// Vopf;[𝕍].
		'Vo' => "\x03pf;\x04𝕍",
		// Vscr;[𝒱].
		'Vs' => "\x03cr;\x04𝒱",
		// Vvdash;[⊪].
		'Vv' => "\x05dash;\x03⊪",
		// Wcirc;[Ŵ].
		'Wc' => "\x04irc;\x02Ŵ",
		// Wedge;[⋀].
		'We' => "\x04dge;\x03⋀",
		// Wfr;[𝔚].
		'Wf' => "\x02r;\x04𝔚",
		// Wopf;[𝕎].
		'Wo' => "\x03pf;\x04𝕎",
		// Wscr;[𝒲].
		'Ws' => "\x03cr;\x04𝒲",
		// Xfr;[𝔛].
		'Xf' => "\x02r;\x04𝔛",
		// Xi;[Ξ].
		'Xi' => "\x01;\x02Ξ",
		// Xopf;[𝕏].
		'Xo' => "\x03pf;\x04𝕏",
		// Xscr;[𝒳].
		'Xs' => "\x03cr;\x04𝒳",
		// YAcy;[Я].
		'YA' => "\x03cy;\x02Я",
		// YIcy;[Ї].
		'YI' => "\x03cy;\x02Ї",
		// YUcy;[Ю].
		'YU' => "\x03cy;\x02Ю",
		// Yacute;[Ý] Yacute[Ý].
		'Ya' => "\x05cute;\x02Ý\x04cute\x02Ý",
		// Ycirc;[Ŷ] Ycy;[Ы].
		'Yc' => "\x04irc;\x02Ŷ\x02y;\x02Ы",
		// Yfr;[𝔜].
		'Yf' => "\x02r;\x04𝔜",
		// Yopf;[𝕐].
		'Yo' => "\x03pf;\x04𝕐",
		// Yscr;[𝒴].
		'Ys' => "\x03cr;\x04𝒴",
		// Yuml;[Ÿ].
		'Yu' => "\x03ml;\x02Ÿ",
		// ZHcy;[Ж].
		'ZH' => "\x03cy;\x02Ж",
		// Zacute;[Ź].
		'Za' => "\x05cute;\x02Ź",
		// Zcaron;[Ž] Zcy;[З].
		'Zc' => "\x05aron;\x02Ž\x02y;\x02З",
		// Zdot;[Ż].
		'Zd' => "\x03ot;\x02Ż",
		// ZeroWidthSpace;[​] Zeta;[Ζ].
		'Ze' => "\x0droWidthSpace;\x03​\x03ta;\x02Ζ",
		// Zfr;[ℨ].
		'Zf' => "\x02r;\x03ℨ",
		// Zopf;[ℤ].
		'Zo' => "\x03pf;\x03ℤ",
		// Zscr;[𝒵].
		'Zs' => "\x03cr;\x04𝒵",
		// aacute;[á] aacute[á].
		'aa' => "\x05cute;\x02á\x04cute\x02á",
		// abreve;[ă].
		'ab' => "\x05reve;\x02ă",
		// acirc;[â] acute;[´] acirc[â] acute[´] acE;[∾̳] acd;[∿] acy;[а] ac;[∾].
		'ac' => "\x04irc;\x02â\x04ute;\x02´\x03irc\x02â\x03ute\x02´\x02E;\x05∾̳\x02d;\x03∿\x02y;\x02а\x01;\x03∾",
		// aelig;[æ] aelig[æ].
		'ae' => "\x04lig;\x02æ\x03lig\x02æ",
		// afr;[𝔞] af;[⁡].
		'af' => "\x02r;\x04𝔞\x01;\x03⁡",
		// agrave;[à] agrave[à].
		'ag' => "\x05rave;\x02à\x04rave\x02à",
		// alefsym;[ℵ] aleph;[ℵ] alpha;[α].
		'al' => "\x06efsym;\x03ℵ\x04eph;\x03ℵ\x04pha;\x02α",
		// amacr;[ā] amalg;[⨿] amp;[&] amp[&].
		'am' => "\x04acr;\x02ā\x04alg;\x03⨿\x02p;\x01&\x01p\x01&",
		// andslope;[⩘] angmsdaa;[⦨] angmsdab;[⦩] angmsdac;[⦪] angmsdad;[⦫] angmsdae;[⦬] angmsdaf;[⦭] angmsdag;[⦮] angmsdah;[⦯] angrtvbd;[⦝] angrtvb;[⊾] angzarr;[⍼] andand;[⩕] angmsd;[∡] angsph;[∢] angle;[∠] angrt;[∟] angst;[Å] andd;[⩜] andv;[⩚] ange;[⦤] and;[∧] ang;[∠].
		'an' => "\x07dslope;\x03⩘\x07gmsdaa;\x03⦨\x07gmsdab;\x03⦩\x07gmsdac;\x03⦪\x07gmsdad;\x03⦫\x07gmsdae;\x03⦬\x07gmsdaf;\x03⦭\x07gmsdag;\x03⦮\x07gmsdah;\x03⦯\x07grtvbd;\x03⦝\x06grtvb;\x03⊾\x06gzarr;\x03⍼\x05dand;\x03⩕\x05gmsd;\x03∡\x05gsph;\x03∢\x04gle;\x03∠\x04grt;\x03∟\x04gst;\x02Å\x03dd;\x03⩜\x03dv;\x03⩚\x03ge;\x03⦤\x02d;\x03∧\x02g;\x03∠",
		// aogon;[ą] aopf;[𝕒].
		'ao' => "\x04gon;\x02ą\x03pf;\x04𝕒",
		// approxeq;[≊] apacir;[⩯] approx;[≈] apid;[≋] apos;[\'] apE;[⩰] ape;[≊] ap;[≈].
		'ap' => "\x07proxeq;\x03≊\x05acir;\x03⩯\x05prox;\x03≈\x03id;\x03≋\x03os;\x01\'\x02E;\x03⩰\x02e;\x03≊\x01;\x03≈",
		// aring;[å] aring[å].
		'ar' => "\x04ing;\x02å\x03ing\x02å",
		// asympeq;[≍] asymp;[≈] ascr;[𝒶] ast;[*].
		'as' => "\x06ympeq;\x03≍\x04ymp;\x03≈\x03cr;\x04𝒶\x02t;\x01*",
		// atilde;[ã] atilde[ã].
		'at' => "\x05ilde;\x02ã\x04ilde\x02ã",
		// auml;[ä] auml[ä].
		'au' => "\x03ml;\x02ä\x02ml\x02ä",
		// awconint;[∳] awint;[⨑].
		'aw' => "\x07conint;\x03∳\x04int;\x03⨑",
		// bNot;[⫭].
		'bN' => "\x03ot;\x03⫭",
		// backepsilon;[϶] backprime;[‵] backsimeq;[⋍] backcong;[≌] barwedge;[⌅] backsim;[∽] barvee;[⊽] barwed;[⌅].
		'ba' => "\x0ackepsilon;\x02϶\x08ckprime;\x03‵\x08cksimeq;\x03⋍\x07ckcong;\x03≌\x07rwedge;\x03⌅\x06cksim;\x03∽\x05rvee;\x03⊽\x05rwed;\x03⌅",
		// bbrktbrk;[⎶] bbrk;[⎵].
		'bb' => "\x07rktbrk;\x03⎶\x03rk;\x03⎵",
		// bcong;[≌] bcy;[б].
		'bc' => "\x04ong;\x03≌\x02y;\x02б",
		// bdquo;[„].
		'bd' => "\x04quo;\x03„",
		// because;[∵] bemptyv;[⦰] between;[≬] becaus;[∵] bernou;[ℬ] bepsi;[϶] beta;[β] beth;[ℶ].
		'be' => "\x06cause;\x03∵\x06mptyv;\x03⦰\x06tween;\x03≬\x05caus;\x03∵\x05rnou;\x03ℬ\x04psi;\x02϶\x03ta;\x02β\x03th;\x03ℶ",
		// bfr;[𝔟].
		'bf' => "\x02r;\x04𝔟",
		// bigtriangledown;[▽] bigtriangleup;[△] bigotimes;[⨂] bigoplus;[⨁] bigsqcup;[⨆] biguplus;[⨄] bigwedge;[⋀] bigcirc;[◯] bigodot;[⨀] bigstar;[★] bigcap;[⋂] bigcup;[⋃] bigvee;[⋁].
		'bi' => "\x0egtriangledown;\x03▽\x0cgtriangleup;\x03△\x08gotimes;\x03⨂\x07goplus;\x03⨁\x07gsqcup;\x03⨆\x07guplus;\x03⨄\x07gwedge;\x03⋀\x06gcirc;\x03◯\x06godot;\x03⨀\x06gstar;\x03★\x05gcap;\x03⋂\x05gcup;\x03⋃\x05gvee;\x03⋁",
		// bkarow;[⤍].
		'bk' => "\x05arow;\x03⤍",
		// blacktriangleright;[▸] blacktriangledown;[▾] blacktriangleleft;[◂] blacktriangle;[▴] blacklozenge;[⧫] blacksquare;[▪] blank;[␣] blk12;[▒] blk14;[░] blk34;[▓] block;[█].
		'bl' => "\x11acktriangleright;\x03▸\x10acktriangledown;\x03▾\x10acktriangleleft;\x03◂\x0cacktriangle;\x03▴\x0backlozenge;\x03⧫\x0aacksquare;\x03▪\x04ank;\x03␣\x04k12;\x03▒\x04k14;\x03░\x04k34;\x03▓\x04ock;\x03█",
		// bnequiv;[≡⃥] bnot;[⌐] bne;[=⃥].
		'bn' => "\x06equiv;\x06≡⃥\x03ot;\x03⌐\x02e;\x04=⃥",
		// boxminus;[⊟] boxtimes;[⊠] boxplus;[⊞] bottom;[⊥] bowtie;[⋈] boxbox;[⧉] boxDL;[╗] boxDR;[╔] boxDl;[╖] boxDr;[╓] boxHD;[╦] boxHU;[╩] boxHd;[╤] boxHu;[╧] boxUL;[╝] boxUR;[╚] boxUl;[╜] boxUr;[╙] boxVH;[╬] boxVL;[╣] boxVR;[╠] boxVh;[╫] boxVl;[╢] boxVr;[╟] boxdL;[╕] boxdR;[╒] boxdl;[┐] boxdr;[┌] boxhD;[╥] boxhU;[╨] boxhd;[┬] boxhu;[┴] boxuL;[╛] boxuR;[╘] boxul;[┘] boxur;[└] boxvH;[╪] boxvL;[╡] boxvR;[╞] boxvh;[┼] boxvl;[┤] boxvr;[├] bopf;[𝕓] boxH;[═] boxV;[║] boxh;[─] boxv;[│] bot;[⊥].
		'bo' => "\x07xminus;\x03⊟\x07xtimes;\x03⊠\x06xplus;\x03⊞\x05ttom;\x03⊥\x05wtie;\x03⋈\x05xbox;\x03⧉\x04xDL;\x03╗\x04xDR;\x03╔\x04xDl;\x03╖\x04xDr;\x03╓\x04xHD;\x03╦\x04xHU;\x03╩\x04xHd;\x03╤\x04xHu;\x03╧\x04xUL;\x03╝\x04xUR;\x03╚\x04xUl;\x03╜\x04xUr;\x03╙\x04xVH;\x03╬\x04xVL;\x03╣\x04xVR;\x03╠\x04xVh;\x03╫\x04xVl;\x03╢\x04xVr;\x03╟\x04xdL;\x03╕\x04xdR;\x03╒\x04xdl;\x03┐\x04xdr;\x03┌\x04xhD;\x03╥\x04xhU;\x03╨\x04xhd;\x03┬\x04xhu;\x03┴\x04xuL;\x03╛\x04xuR;\x03╘\x04xul;\x03┘\x04xur;\x03└\x04xvH;\x03╪\x04xvL;\x03╡\x04xvR;\x03╞\x04xvh;\x03┼\x04xvl;\x03┤\x04xvr;\x03├\x03pf;\x04𝕓\x03xH;\x03═\x03xV;\x03║\x03xh;\x03─\x03xv;\x03│\x02t;\x03⊥",
		// bprime;[‵].
		'bp' => "\x05rime;\x03‵",
		// brvbar;[¦] breve;[˘] brvbar[¦].
		'br' => "\x05vbar;\x02¦\x04eve;\x02˘\x04vbar\x02¦",
		// bsolhsub;[⟈] bsemi;[⁏] bsime;[⋍] bsolb;[⧅] bscr;[𝒷] bsim;[∽] bsol;[\\].
		'bs' => "\x07olhsub;\x03⟈\x04emi;\x03⁏\x04ime;\x03⋍\x04olb;\x03⧅\x03cr;\x04𝒷\x03im;\x03∽\x03ol;\x01\\",
		// bullet;[•] bumpeq;[≏] bumpE;[⪮] bumpe;[≏] bull;[•] bump;[≎].
		'bu' => "\x05llet;\x03•\x05mpeq;\x03≏\x04mpE;\x03⪮\x04mpe;\x03≏\x03ll;\x03•\x03mp;\x03≎",
		// capbrcup;[⩉] cacute;[ć] capand;[⩄] capcap;[⩋] capcup;[⩇] capdot;[⩀] caret;[⁁] caron;[ˇ] caps;[∩︀] cap;[∩].
		'ca' => "\x07pbrcup;\x03⩉\x05cute;\x02ć\x05pand;\x03⩄\x05pcap;\x03⩋\x05pcup;\x03⩇\x05pdot;\x03⩀\x04ret;\x03⁁\x04ron;\x02ˇ\x03ps;\x06∩︀\x02p;\x03∩",
		// ccupssm;[⩐] ccaron;[č] ccedil;[ç] ccaps;[⩍] ccedil[ç] ccirc;[ĉ] ccups;[⩌].
		'cc' => "\x06upssm;\x03⩐\x05aron;\x02č\x05edil;\x02ç\x04aps;\x03⩍\x04edil\x02ç\x04irc;\x02ĉ\x04ups;\x03⩌",
		// cdot;[ċ].
		'cd' => "\x03ot;\x02ċ",
		// centerdot;[·] cemptyv;[⦲] cedil;[¸] cedil[¸] cent;[¢] cent[¢].
		'ce' => "\x08nterdot;\x02·\x06mptyv;\x03⦲\x04dil;\x02¸\x03dil\x02¸\x03nt;\x02¢\x02nt\x02¢",
		// cfr;[𝔠].
		'cf' => "\x02r;\x04𝔠",
		// checkmark;[✓] check;[✓] chcy;[ч] chi;[χ].
		'ch' => "\x08eckmark;\x03✓\x04eck;\x03✓\x03cy;\x02ч\x02i;\x02χ",
		// circlearrowright;[↻] circlearrowleft;[↺] circledcirc;[⊚] circleddash;[⊝] circledast;[⊛] circledR;[®] circledS;[Ⓢ] cirfnint;[⨐] cirscir;[⧂] circeq;[≗] cirmid;[⫯] cirE;[⧃] circ;[ˆ] cire;[≗] cir;[○].
		'ci' => "\x0frclearrowright;\x03↻\x0erclearrowleft;\x03↺\x0arcledcirc;\x03⊚\x0arcleddash;\x03⊝\x09rcledast;\x03⊛\x07rcledR;\x02®\x07rcledS;\x03Ⓢ\x07rfnint;\x03⨐\x06rscir;\x03⧂\x05rceq;\x03≗\x05rmid;\x03⫯\x03rE;\x03⧃\x03rc;\x02ˆ\x03re;\x03≗\x02r;\x03○",
		// clubsuit;[♣] clubs;[♣].
		'cl' => "\x07ubsuit;\x03♣\x04ubs;\x03♣",
		// complement;[∁] complexes;[ℂ] coloneq;[≔] congdot;[⩭] colone;[≔] commat;[@] compfn;[∘] conint;[∮] coprod;[∐] copysr;[℗] colon;[:] comma;[,] comp;[∁] cong;[≅] copf;[𝕔] copy;[©] copy[©].
		'co' => "\x09mplement;\x03∁\x08mplexes;\x03ℂ\x06loneq;\x03≔\x06ngdot;\x03⩭\x05lone;\x03≔\x05mmat;\x01@\x05mpfn;\x03∘\x05nint;\x03∮\x05prod;\x03∐\x05pysr;\x03℗\x04lon;\x01:\x04mma;\x01,\x03mp;\x03∁\x03ng;\x03≅\x03pf;\x04𝕔\x03py;\x02©\x02py\x02©",
		// crarr;[↵] cross;[✗].
		'cr' => "\x04arr;\x03↵\x04oss;\x03✗",
		// csube;[⫑] csupe;[⫒] cscr;[𝒸] csub;[⫏] csup;[⫐].
		'cs' => "\x04ube;\x03⫑\x04upe;\x03⫒\x03cr;\x04𝒸\x03ub;\x03⫏\x03up;\x03⫐",
		// ctdot;[⋯].
		'ct' => "\x04dot;\x03⋯",
		// curvearrowright;[↷] curvearrowleft;[↶] curlyeqprec;[⋞] curlyeqsucc;[⋟] curlywedge;[⋏] cupbrcap;[⩈] curlyvee;[⋎] cudarrl;[⤸] cudarrr;[⤵] cularrp;[⤽] curarrm;[⤼] cularr;[↶] cupcap;[⩆] cupcup;[⩊] cupdot;[⊍] curarr;[↷] curren;[¤] cuepr;[⋞] cuesc;[⋟] cupor;[⩅] curren[¤] cuvee;[⋎] cuwed;[⋏] cups;[∪︀] cup;[∪].
		'cu' => "\x0ervearrowright;\x03↷\x0drvearrowleft;\x03↶\x0arlyeqprec;\x03⋞\x0arlyeqsucc;\x03⋟\x09rlywedge;\x03⋏\x07pbrcap;\x03⩈\x07rlyvee;\x03⋎\x06darrl;\x03⤸\x06darrr;\x03⤵\x06larrp;\x03⤽\x06rarrm;\x03⤼\x05larr;\x03↶\x05pcap;\x03⩆\x05pcup;\x03⩊\x05pdot;\x03⊍\x05rarr;\x03↷\x05rren;\x02¤\x04epr;\x03⋞\x04esc;\x03⋟\x04por;\x03⩅\x04rren\x02¤\x04vee;\x03⋎\x04wed;\x03⋏\x03ps;\x06∪︀\x02p;\x03∪",
		// cwconint;[∲] cwint;[∱].
		'cw' => "\x07conint;\x03∲\x04int;\x03∱",
		// cylcty;[⌭].
		'cy' => "\x05lcty;\x03⌭",
		// dArr;[⇓].
		'dA' => "\x03rr;\x03⇓",
		// dHar;[⥥].
		'dH' => "\x03ar;\x03⥥",
		// dagger;[†] daleth;[ℸ] dashv;[⊣] darr;[↓] dash;[‐].
		'da' => "\x05gger;\x03†\x05leth;\x03ℸ\x04shv;\x03⊣\x03rr;\x03↓\x03sh;\x03‐",
		// dbkarow;[⤏] dblac;[˝].
		'db' => "\x06karow;\x03⤏\x04lac;\x02˝",
		// dcaron;[ď] dcy;[д].
		'dc' => "\x05aron;\x02ď\x02y;\x02д",
		// ddagger;[‡] ddotseq;[⩷] ddarr;[⇊] dd;[ⅆ].
		'dd' => "\x06agger;\x03‡\x06otseq;\x03⩷\x04arr;\x03⇊\x01;\x03ⅆ",
		// demptyv;[⦱] delta;[δ] deg;[°] deg[°].
		'de' => "\x06mptyv;\x03⦱\x04lta;\x02δ\x02g;\x02°\x01g\x02°",
		// dfisht;[⥿] dfr;[𝔡].
		'df' => "\x05isht;\x03⥿\x02r;\x04𝔡",
		// dharl;[⇃] dharr;[⇂].
		'dh' => "\x04arl;\x03⇃\x04arr;\x03⇂",
		// divideontimes;[⋇] diamondsuit;[♦] diamond;[⋄] digamma;[ϝ] divide;[÷] divonx;[⋇] diams;[♦] disin;[⋲] divide[÷] diam;[⋄] die;[¨] div;[÷].
		'di' => "\x0cvideontimes;\x03⋇\x0aamondsuit;\x03♦\x06amond;\x03⋄\x06gamma;\x02ϝ\x05vide;\x02÷\x05vonx;\x03⋇\x04ams;\x03♦\x04sin;\x03⋲\x04vide\x02÷\x03am;\x03⋄\x02e;\x02¨\x02v;\x02÷",
		// djcy;[ђ].
		'dj' => "\x03cy;\x02ђ",
		// dlcorn;[⌞] dlcrop;[⌍].
		'dl' => "\x05corn;\x03⌞\x05crop;\x03⌍",
		// downharpoonright;[⇂] downharpoonleft;[⇃] doublebarwedge;[⌆] downdownarrows;[⇊] dotsquare;[⊡] downarrow;[↓] doteqdot;[≑] dotminus;[∸] dotplus;[∔] dollar;[$] doteq;[≐] dopf;[𝕕] dot;[˙].
		'do' => "\x0fwnharpoonright;\x03⇂\x0ewnharpoonleft;\x03⇃\x0dublebarwedge;\x03⌆\x0dwndownarrows;\x03⇊\x08tsquare;\x03⊡\x08wnarrow;\x03↓\x07teqdot;\x03≑\x07tminus;\x03∸\x06tplus;\x03∔\x05llar;\x01$\x04teq;\x03≐\x03pf;\x04𝕕\x02t;\x02˙",
		// drbkarow;[⤐] drcorn;[⌟] drcrop;[⌌].
		'dr' => "\x07bkarow;\x03⤐\x05corn;\x03⌟\x05crop;\x03⌌",
		// dstrok;[đ] dscr;[𝒹] dscy;[ѕ] dsol;[⧶].
		'ds' => "\x05trok;\x02đ\x03cr;\x04𝒹\x03cy;\x02ѕ\x03ol;\x03⧶",
		// dtdot;[⋱] dtrif;[▾] dtri;[▿].
		'dt' => "\x04dot;\x03⋱\x04rif;\x03▾\x03ri;\x03▿",
		// duarr;[⇵] duhar;[⥯].
		'du' => "\x04arr;\x03⇵\x04har;\x03⥯",
		// dwangle;[⦦].
		'dw' => "\x06angle;\x03⦦",
		// dzigrarr;[⟿] dzcy;[џ].
		'dz' => "\x07igrarr;\x03⟿\x03cy;\x02џ",
		// eDDot;[⩷] eDot;[≑].
		'eD' => "\x04Dot;\x03⩷\x03ot;\x03≑",
		// eacute;[é] easter;[⩮] eacute[é].
		'ea' => "\x05cute;\x02é\x05ster;\x03⩮\x04cute\x02é",
		// ecaron;[ě] ecolon;[≕] ecirc;[ê] ecir;[≖] ecirc[ê] ecy;[э].
		'ec' => "\x05aron;\x02ě\x05olon;\x03≕\x04irc;\x02ê\x03ir;\x03≖\x03irc\x02ê\x02y;\x02э",
		// edot;[ė].
		'ed' => "\x03ot;\x02ė",
		// ee;[ⅇ].
		'ee' => "\x01;\x03ⅇ",
		// efDot;[≒] efr;[𝔢].
		'ef' => "\x04Dot;\x03≒\x02r;\x04𝔢",
		// egrave;[è] egsdot;[⪘] egrave[è] egs;[⪖] eg;[⪚].
		'eg' => "\x05rave;\x02è\x05sdot;\x03⪘\x04rave\x02è\x02s;\x03⪖\x01;\x03⪚",
		// elinters;[⏧] elsdot;[⪗] ell;[ℓ] els;[⪕] el;[⪙].
		'el' => "\x07inters;\x03⏧\x05sdot;\x03⪗\x02l;\x03ℓ\x02s;\x03⪕\x01;\x03⪙",
		// emptyset;[∅] emptyv;[∅] emsp13;[ ] emsp14;[ ] emacr;[ē] empty;[∅] emsp;[ ].
		'em' => "\x07ptyset;\x03∅\x05ptyv;\x03∅\x05sp13;\x03 \x05sp14;\x03 \x04acr;\x02ē\x04pty;\x03∅\x03sp;\x03 ",
		// ensp;[ ] eng;[ŋ].
		'en' => "\x03sp;\x03 \x02g;\x02ŋ",
		// eogon;[ę] eopf;[𝕖].
		'eo' => "\x04gon;\x02ę\x03pf;\x04𝕖",
		// epsilon;[ε] eparsl;[⧣] eplus;[⩱] epsiv;[ϵ] epar;[⋕] epsi;[ε].
		'ep' => "\x06silon;\x02ε\x05arsl;\x03⧣\x04lus;\x03⩱\x04siv;\x02ϵ\x03ar;\x03⋕\x03si;\x02ε",
		// eqslantless;[⪕] eqslantgtr;[⪖] eqvparsl;[⧥] eqcolon;[≕] equivDD;[⩸] eqcirc;[≖] equals;[=] equest;[≟] eqsim;[≂] equiv;[≡].
		'eq' => "\x0aslantless;\x03⪕\x09slantgtr;\x03⪖\x07vparsl;\x03⧥\x06colon;\x03≕\x06uivDD;\x03⩸\x05circ;\x03≖\x05uals;\x01=\x05uest;\x03≟\x04sim;\x03≂\x04uiv;\x03≡",
		// erDot;[≓] erarr;[⥱].
		'er' => "\x04Dot;\x03≓\x04arr;\x03⥱",
		// esdot;[≐] escr;[ℯ] esim;[≂].
		'es' => "\x04dot;\x03≐\x03cr;\x03ℯ\x03im;\x03≂",
		// eta;[η] eth;[ð] eth[ð].
		'et' => "\x02a;\x02η\x02h;\x02ð\x01h\x02ð",
		// euml;[ë] euro;[€] euml[ë].
		'eu' => "\x03ml;\x02ë\x03ro;\x03€\x02ml\x02ë",
		// exponentiale;[ⅇ] expectation;[ℰ] exist;[∃] excl;[!].
		'ex' => "\x0bponentiale;\x03ⅇ\x0apectation;\x03ℰ\x04ist;\x03∃\x03cl;\x01!",
		// fallingdotseq;[≒].
		'fa' => "\x0cllingdotseq;\x03≒",
		// fcy;[ф].
		'fc' => "\x02y;\x02ф",
		// female;[♀].
		'fe' => "\x05male;\x03♀",
		// ffilig;[ﬃ] ffllig;[ﬄ] fflig;[ﬀ] ffr;[𝔣].
		'ff' => "\x05ilig;\x03ﬃ\x05llig;\x03ﬄ\x04lig;\x03ﬀ\x02r;\x04𝔣",
		// filig;[ﬁ].
		'fi' => "\x04lig;\x03ﬁ",
		// fjlig;[fj].
		'fj' => "\x04lig;\x02fj",
		// fllig;[ﬂ] fltns;[▱] flat;[♭].
		'fl' => "\x04lig;\x03ﬂ\x04tns;\x03▱\x03at;\x03♭",
		// fnof;[ƒ].
		'fn' => "\x03of;\x02ƒ",
		// forall;[∀] forkv;[⫙] fopf;[𝕗] fork;[⋔].
		'fo' => "\x05rall;\x03∀\x04rkv;\x03⫙\x03pf;\x04𝕗\x03rk;\x03⋔",
		// fpartint;[⨍].
		'fp' => "\x07artint;\x03⨍",
		// frac12;[½] frac13;[⅓] frac14;[¼] frac15;[⅕] frac16;[⅙] frac18;[⅛] frac23;[⅔] frac25;[⅖] frac34;[¾] frac35;[⅗] frac38;[⅜] frac45;[⅘] frac56;[⅚] frac58;[⅝] frac78;[⅞] frac12[½] frac14[¼] frac34[¾] frasl;[⁄] frown;[⌢].
		'fr' => "\x05ac12;\x02½\x05ac13;\x03⅓\x05ac14;\x02¼\x05ac15;\x03⅕\x05ac16;\x03⅙\x05ac18;\x03⅛\x05ac23;\x03⅔\x05ac25;\x03⅖\x05ac34;\x02¾\x05ac35;\x03⅗\x05ac38;\x03⅜\x05ac45;\x03⅘\x05ac56;\x03⅚\x05ac58;\x03⅝\x05ac78;\x03⅞\x04ac12\x02½\x04ac14\x02¼\x04ac34\x02¾\x04asl;\x03⁄\x04own;\x03⌢",
		// fscr;[𝒻].
		'fs' => "\x03cr;\x04𝒻",
		// gEl;[⪌] gE;[≧].
		'gE' => "\x02l;\x03⪌\x01;\x03≧",
		// gacute;[ǵ] gammad;[ϝ] gamma;[γ] gap;[⪆].
		'ga' => "\x05cute;\x02ǵ\x05mmad;\x02ϝ\x04mma;\x02γ\x02p;\x03⪆",
		// gbreve;[ğ].
		'gb' => "\x05reve;\x02ğ",
		// gcirc;[ĝ] gcy;[г].
		'gc' => "\x04irc;\x02ĝ\x02y;\x02г",
		// gdot;[ġ].
		'gd' => "\x03ot;\x02ġ",
		// geqslant;[⩾] gesdotol;[⪄] gesdoto;[⪂] gesdot;[⪀] gesles;[⪔] gescc;[⪩] geqq;[≧] gesl;[⋛︀] gel;[⋛] geq;[≥] ges;[⩾] ge;[≥].
		'ge' => "\x07qslant;\x03⩾\x07sdotol;\x03⪄\x06sdoto;\x03⪂\x05sdot;\x03⪀\x05sles;\x03⪔\x04scc;\x03⪩\x03qq;\x03≧\x03sl;\x06⋛︀\x02l;\x03⋛\x02q;\x03≥\x02s;\x03⩾\x01;\x03≥",
		// gfr;[𝔤].
		'gf' => "\x02r;\x04𝔤",
		// ggg;[⋙] gg;[≫].
		'gg' => "\x02g;\x03⋙\x01;\x03≫",
		// gimel;[ℷ].
		'gi' => "\x04mel;\x03ℷ",
		// gjcy;[ѓ].
		'gj' => "\x03cy;\x02ѓ",
		// glE;[⪒] gla;[⪥] glj;[⪤] gl;[≷].
		'gl' => "\x02E;\x03⪒\x02a;\x03⪥\x02j;\x03⪤\x01;\x03≷",
		// gnapprox;[⪊] gneqq;[≩] gnsim;[⋧] gnap;[⪊] gneq;[⪈] gnE;[≩] gne;[⪈].
		'gn' => "\x07approx;\x03⪊\x04eqq;\x03≩\x04sim;\x03⋧\x03ap;\x03⪊\x03eq;\x03⪈\x02E;\x03≩\x02e;\x03⪈",
		// gopf;[𝕘].
		'go' => "\x03pf;\x04𝕘",
		// grave;[`].
		'gr' => "\x04ave;\x01`",
		// gsime;[⪎] gsiml;[⪐] gscr;[ℊ] gsim;[≳].
		'gs' => "\x04ime;\x03⪎\x04iml;\x03⪐\x03cr;\x03ℊ\x03im;\x03≳",
		// gtreqqless;[⪌] gtrapprox;[⪆] gtreqless;[⋛] gtquest;[⩼] gtrless;[≷] gtlPar;[⦕] gtrarr;[⥸] gtrdot;[⋗] gtrsim;[≳] gtcir;[⩺] gtdot;[⋗] gtcc;[⪧] gt;[>].
		'gt' => "\x09reqqless;\x03⪌\x08rapprox;\x03⪆\x08reqless;\x03⋛\x06quest;\x03⩼\x06rless;\x03≷\x05lPar;\x03⦕\x05rarr;\x03⥸\x05rdot;\x03⋗\x05rsim;\x03≳\x04cir;\x03⩺\x04dot;\x03⋗\x03cc;\x03⪧\x01;\x01>",
		// gvertneqq;[≩︀] gvnE;[≩︀].
		'gv' => "\x08ertneqq;\x06≩︀\x03nE;\x06≩︀",
		// hArr;[⇔].
		'hA' => "\x03rr;\x03⇔",
		// harrcir;[⥈] hairsp;[ ] hamilt;[ℋ] hardcy;[ъ] harrw;[↭] half;[½] harr;[↔].
		'ha' => "\x06rrcir;\x03⥈\x05irsp;\x03 \x05milt;\x03ℋ\x05rdcy;\x02ъ\x04rrw;\x03↭\x03lf;\x02½\x03rr;\x03↔",
		// hbar;[ℏ].
		'hb' => "\x03ar;\x03ℏ",
		// hcirc;[ĥ].
		'hc' => "\x04irc;\x02ĥ",
		// heartsuit;[♥] hearts;[♥] hellip;[…] hercon;[⊹].
		'he' => "\x08artsuit;\x03♥\x05arts;\x03♥\x05llip;\x03…\x05rcon;\x03⊹",
		// hfr;[𝔥].
		'hf' => "\x02r;\x04𝔥",
		// hksearow;[⤥] hkswarow;[⤦].
		'hk' => "\x07searow;\x03⤥\x07swarow;\x03⤦",
		// hookrightarrow;[↪] hookleftarrow;[↩] homtht;[∻] horbar;[―] hoarr;[⇿] hopf;[𝕙].
		'ho' => "\x0dokrightarrow;\x03↪\x0cokleftarrow;\x03↩\x05mtht;\x03∻\x05rbar;\x03―\x04arr;\x03⇿\x03pf;\x04𝕙",
		// hslash;[ℏ] hstrok;[ħ] hscr;[𝒽].
		'hs' => "\x05lash;\x03ℏ\x05trok;\x02ħ\x03cr;\x04𝒽",
		// hybull;[⁃] hyphen;[‐].
		'hy' => "\x05bull;\x03⁃\x05phen;\x03‐",
		// iacute;[í] iacute[í].
		'ia' => "\x05cute;\x02í\x04cute\x02í",
		// icirc;[î] icirc[î] icy;[и] ic;[⁣].
		'ic' => "\x04irc;\x02î\x03irc\x02î\x02y;\x02и\x01;\x03⁣",
		// iexcl;[¡] iecy;[е] iexcl[¡].
		'ie' => "\x04xcl;\x02¡\x03cy;\x02е\x03xcl\x02¡",
		// iff;[⇔] ifr;[𝔦].
		'if' => "\x02f;\x03⇔\x02r;\x04𝔦",
		// igrave;[ì] igrave[ì].
		'ig' => "\x05rave;\x02ì\x04rave\x02ì",
		// iiiint;[⨌] iinfin;[⧜] iiint;[∭] iiota;[℩] ii;[ⅈ].
		'ii' => "\x05iint;\x03⨌\x05nfin;\x03⧜\x04int;\x03∭\x04ota;\x03℩\x01;\x03ⅈ",
		// ijlig;[ĳ].
		'ij' => "\x04lig;\x02ĳ",
		// imagline;[ℐ] imagpart;[ℑ] imacr;[ī] image;[ℑ] imath;[ı] imped;[Ƶ] imof;[⊷].
		'im' => "\x07agline;\x03ℐ\x07agpart;\x03ℑ\x04acr;\x02ī\x04age;\x03ℑ\x04ath;\x02ı\x04ped;\x02Ƶ\x03of;\x03⊷",
		// infintie;[⧝] integers;[ℤ] intercal;[⊺] intlarhk;[⨗] intprod;[⨼] incare;[℅] inodot;[ı] intcal;[⊺] infin;[∞] int;[∫] in;[∈].
		'in' => "\x07fintie;\x03⧝\x07tegers;\x03ℤ\x07tercal;\x03⊺\x07tlarhk;\x03⨗\x06tprod;\x03⨼\x05care;\x03℅\x05odot;\x02ı\x05tcal;\x03⊺\x04fin;\x03∞\x02t;\x03∫\x01;\x03∈",
		// iogon;[į] iocy;[ё] iopf;[𝕚] iota;[ι].
		'io' => "\x04gon;\x02į\x03cy;\x02ё\x03pf;\x04𝕚\x03ta;\x02ι",
		// iprod;[⨼].
		'ip' => "\x04rod;\x03⨼",
		// iquest;[¿] iquest[¿].
		'iq' => "\x05uest;\x02¿\x04uest\x02¿",
		// isindot;[⋵] isinsv;[⋳] isinE;[⋹] isins;[⋴] isinv;[∈] iscr;[𝒾] isin;[∈].
		'is' => "\x06indot;\x03⋵\x05insv;\x03⋳\x04inE;\x03⋹\x04ins;\x03⋴\x04inv;\x03∈\x03cr;\x04𝒾\x03in;\x03∈",
		// itilde;[ĩ] it;[⁢].
		'it' => "\x05ilde;\x02ĩ\x01;\x03⁢",
		// iukcy;[і] iuml;[ï] iuml[ï].
		'iu' => "\x04kcy;\x02і\x03ml;\x02ï\x02ml\x02ï",
		// jcirc;[ĵ] jcy;[й].
		'jc' => "\x04irc;\x02ĵ\x02y;\x02й",
		// jfr;[𝔧].
		'jf' => "\x02r;\x04𝔧",
		// jmath;[ȷ].
		'jm' => "\x04ath;\x02ȷ",
		// jopf;[𝕛].
		'jo' => "\x03pf;\x04𝕛",
		// jsercy;[ј] jscr;[𝒿].
		'js' => "\x05ercy;\x02ј\x03cr;\x04𝒿",
		// jukcy;[є].
		'ju' => "\x04kcy;\x02є",
		// kappav;[ϰ] kappa;[κ].
		'ka' => "\x05ppav;\x02ϰ\x04ppa;\x02κ",
		// kcedil;[ķ] kcy;[к].
		'kc' => "\x05edil;\x02ķ\x02y;\x02к",
		// kfr;[𝔨].
		'kf' => "\x02r;\x04𝔨",
		// kgreen;[ĸ].
		'kg' => "\x05reen;\x02ĸ",
		// khcy;[х].
		'kh' => "\x03cy;\x02х",
		// kjcy;[ќ].
		'kj' => "\x03cy;\x02ќ",
		// kopf;[𝕜].
		'ko' => "\x03pf;\x04𝕜",
		// kscr;[𝓀].
		'ks' => "\x03cr;\x04𝓀",
		// lAtail;[⤛] lAarr;[⇚] lArr;[⇐].
		'lA' => "\x05tail;\x03⤛\x04arr;\x03⇚\x03rr;\x03⇐",
		// lBarr;[⤎].
		'lB' => "\x04arr;\x03⤎",
		// lEg;[⪋] lE;[≦].
		'lE' => "\x02g;\x03⪋\x01;\x03≦",
		// lHar;[⥢].
		'lH' => "\x03ar;\x03⥢",
		// laemptyv;[⦴] larrbfs;[⤟] larrsim;[⥳] lacute;[ĺ] lagran;[ℒ] lambda;[λ] langle;[⟨] larrfs;[⤝] larrhk;[↩] larrlp;[↫] larrpl;[⤹] larrtl;[↢] latail;[⤙] langd;[⦑] laquo;[«] larrb;[⇤] lates;[⪭︀] lang;[⟨] laquo[«] larr;[←] late;[⪭] lap;[⪅] lat;[⪫].
		'la' => "\x07emptyv;\x03⦴\x06rrbfs;\x03⤟\x06rrsim;\x03⥳\x05cute;\x02ĺ\x05gran;\x03ℒ\x05mbda;\x02λ\x05ngle;\x03⟨\x05rrfs;\x03⤝\x05rrhk;\x03↩\x05rrlp;\x03↫\x05rrpl;\x03⤹\x05rrtl;\x03↢\x05tail;\x03⤙\x04ngd;\x03⦑\x04quo;\x02«\x04rrb;\x03⇤\x04tes;\x06⪭︀\x03ng;\x03⟨\x03quo\x02«\x03rr;\x03←\x03te;\x03⪭\x02p;\x03⪅\x02t;\x03⪫",
		// lbrksld;[⦏] lbrkslu;[⦍] lbrace;[{] lbrack;[[] lbarr;[⤌] lbbrk;[❲] lbrke;[⦋].
		'lb' => "\x06rksld;\x03⦏\x06rkslu;\x03⦍\x05race;\x01{\x05rack;\x01[\x04arr;\x03⤌\x04brk;\x03❲\x04rke;\x03⦋",
		// lcaron;[ľ] lcedil;[ļ] lceil;[⌈] lcub;[{] lcy;[л].
		'lc' => "\x05aron;\x02ľ\x05edil;\x02ļ\x04eil;\x03⌈\x03ub;\x01{\x02y;\x02л",
		// ldrushar;[⥋] ldrdhar;[⥧] ldquor;[„] ldquo;[“] ldca;[⤶] ldsh;[↲].
		'ld' => "\x07rushar;\x03⥋\x06rdhar;\x03⥧\x05quor;\x03„\x04quo;\x03“\x03ca;\x03⤶\x03sh;\x03↲",
		// leftrightsquigarrow;[↭] leftrightharpoons;[⇋] leftharpoondown;[↽] leftrightarrows;[⇆] leftleftarrows;[⇇] leftrightarrow;[↔] leftthreetimes;[⋋] leftarrowtail;[↢] leftharpoonup;[↼] lessapprox;[⪅] lesseqqgtr;[⪋] leftarrow;[←] lesseqgtr;[⋚] leqslant;[⩽] lesdotor;[⪃] lesdoto;[⪁] lessdot;[⋖] lessgtr;[≶] lesssim;[≲] lesdot;[⩿] lesges;[⪓] lescc;[⪨] leqq;[≦] lesg;[⋚︀] leg;[⋚] leq;[≤] les;[⩽] le;[≤].
		'le' => "\x12ftrightsquigarrow;\x03↭\x10ftrightharpoons;\x03⇋\x0eftharpoondown;\x03↽\x0eftrightarrows;\x03⇆\x0dftleftarrows;\x03⇇\x0dftrightarrow;\x03↔\x0dftthreetimes;\x03⋋\x0cftarrowtail;\x03↢\x0cftharpoonup;\x03↼\x09ssapprox;\x03⪅\x09sseqqgtr;\x03⪋\x08ftarrow;\x03←\x08sseqgtr;\x03⋚\x07qslant;\x03⩽\x07sdotor;\x03⪃\x06sdoto;\x03⪁\x06ssdot;\x03⋖\x06ssgtr;\x03≶\x06sssim;\x03≲\x05sdot;\x03⩿\x05sges;\x03⪓\x04scc;\x03⪨\x03qq;\x03≦\x03sg;\x06⋚︀\x02g;\x03⋚\x02q;\x03≤\x02s;\x03⩽\x01;\x03≤",
		// lfisht;[⥼] lfloor;[⌊] lfr;[𝔩].
		'lf' => "\x05isht;\x03⥼\x05loor;\x03⌊\x02r;\x04𝔩",
		// lgE;[⪑] lg;[≶].
		'lg' => "\x02E;\x03⪑\x01;\x03≶",
		// lharul;[⥪] lhard;[↽] lharu;[↼] lhblk;[▄].
		'lh' => "\x05arul;\x03⥪\x04ard;\x03↽\x04aru;\x03↼\x04blk;\x03▄",
		// ljcy;[љ].
		'lj' => "\x03cy;\x02љ",
		// llcorner;[⌞] llhard;[⥫] llarr;[⇇] lltri;[◺] ll;[≪].
		'll' => "\x07corner;\x03⌞\x05hard;\x03⥫\x04arr;\x03⇇\x04tri;\x03◺\x01;\x03≪",
		// lmoustache;[⎰] lmidot;[ŀ] lmoust;[⎰].
		'lm' => "\x09oustache;\x03⎰\x05idot;\x02ŀ\x05oust;\x03⎰",
		// lnapprox;[⪉] lneqq;[≨] lnsim;[⋦] lnap;[⪉] lneq;[⪇] lnE;[≨] lne;[⪇].
		'ln' => "\x07approx;\x03⪉\x04eqq;\x03≨\x04sim;\x03⋦\x03ap;\x03⪉\x03eq;\x03⪇\x02E;\x03≨\x02e;\x03⪇",
		// longleftrightarrow;[⟷] longrightarrow;[⟶] looparrowright;[↬] longleftarrow;[⟵] looparrowleft;[↫] longmapsto;[⟼] lotimes;[⨴] lozenge;[◊] loplus;[⨭] lowast;[∗] lowbar;[_] loang;[⟬] loarr;[⇽] lobrk;[⟦] lopar;[⦅] lopf;[𝕝] lozf;[⧫] loz;[◊].
		'lo' => "\x11ngleftrightarrow;\x03⟷\x0dngrightarrow;\x03⟶\x0doparrowright;\x03↬\x0cngleftarrow;\x03⟵\x0coparrowleft;\x03↫\x09ngmapsto;\x03⟼\x06times;\x03⨴\x06zenge;\x03◊\x05plus;\x03⨭\x05wast;\x03∗\x05wbar;\x01_\x04ang;\x03⟬\x04arr;\x03⇽\x04brk;\x03⟦\x04par;\x03⦅\x03pf;\x04𝕝\x03zf;\x03⧫\x02z;\x03◊",
		// lparlt;[⦓] lpar;[(].
		'lp' => "\x05arlt;\x03⦓\x03ar;\x01(",
		// lrcorner;[⌟] lrhard;[⥭] lrarr;[⇆] lrhar;[⇋] lrtri;[⊿] lrm;[‎].
		'lr' => "\x07corner;\x03⌟\x05hard;\x03⥭\x04arr;\x03⇆\x04har;\x03⇋\x04tri;\x03⊿\x02m;\x03‎",
		// lsaquo;[‹] lsquor;[‚] lstrok;[ł] lsime;[⪍] lsimg;[⪏] lsquo;[‘] lscr;[𝓁] lsim;[≲] lsqb;[[] lsh;[↰].
		'ls' => "\x05aquo;\x03‹\x05quor;\x03‚\x05trok;\x02ł\x04ime;\x03⪍\x04img;\x03⪏\x04quo;\x03‘\x03cr;\x04𝓁\x03im;\x03≲\x03qb;\x01[\x02h;\x03↰",
		// ltquest;[⩻] lthree;[⋋] ltimes;[⋉] ltlarr;[⥶] ltrPar;[⦖] ltcir;[⩹] ltdot;[⋖] ltrie;[⊴] ltrif;[◂] ltcc;[⪦] ltri;[◃] lt;[<].
		'lt' => "\x06quest;\x03⩻\x05hree;\x03⋋\x05imes;\x03⋉\x05larr;\x03⥶\x05rPar;\x03⦖\x04cir;\x03⩹\x04dot;\x03⋖\x04rie;\x03⊴\x04rif;\x03◂\x03cc;\x03⪦\x03ri;\x03◃\x01;\x01<",
		// lurdshar;[⥊] luruhar;[⥦].
		'lu' => "\x07rdshar;\x03⥊\x06ruhar;\x03⥦",
		// lvertneqq;[≨︀] lvnE;[≨︀].
		'lv' => "\x08ertneqq;\x06≨︀\x03nE;\x06≨︀",
		// mDDot;[∺].
		'mD' => "\x04Dot;\x03∺",
		// mapstodown;[↧] mapstoleft;[↤] mapstoup;[↥] maltese;[✠] mapsto;[↦] marker;[▮] macr;[¯] male;[♂] malt;[✠] macr[¯] map;[↦].
		'ma' => "\x09pstodown;\x03↧\x09pstoleft;\x03↤\x07pstoup;\x03↥\x06ltese;\x03✠\x05psto;\x03↦\x05rker;\x03▮\x03cr;\x02¯\x03le;\x03♂\x03lt;\x03✠\x02cr\x02¯\x02p;\x03↦",
		// mcomma;[⨩] mcy;[м].
		'mc' => "\x05omma;\x03⨩\x02y;\x02м",
		// mdash;[—].
		'md' => "\x04ash;\x03—",
		// measuredangle;[∡].
		'me' => "\x0casuredangle;\x03∡",
		// mfr;[𝔪].
		'mf' => "\x02r;\x04𝔪",
		// mho;[℧].
		'mh' => "\x02o;\x03℧",
		// minusdu;[⨪] midast;[*] midcir;[⫰] middot;[·] minusb;[⊟] minusd;[∸] micro;[µ] middot[·] minus;[−] micro[µ] mid;[∣].
		'mi' => "\x06nusdu;\x03⨪\x05dast;\x01*\x05dcir;\x03⫰\x05ddot;\x02·\x05nusb;\x03⊟\x05nusd;\x03∸\x04cro;\x02µ\x04ddot\x02·\x04nus;\x03−\x03cro\x02µ\x02d;\x03∣",
		// mlcp;[⫛] mldr;[…].
		'ml' => "\x03cp;\x03⫛\x03dr;\x03…",
		// mnplus;[∓].
		'mn' => "\x05plus;\x03∓",
		// models;[⊧] mopf;[𝕞].
		'mo' => "\x05dels;\x03⊧\x03pf;\x04𝕞",
		// mp;[∓].
		'mp' => "\x01;\x03∓",
		// mstpos;[∾] mscr;[𝓂].
		'ms' => "\x05tpos;\x03∾\x03cr;\x04𝓂",
		// multimap;[⊸] mumap;[⊸] mu;[μ].
		'mu' => "\x07ltimap;\x03⊸\x04map;\x03⊸\x01;\x02μ",
		// nGtv;[≫̸] nGg;[⋙̸] nGt;[≫⃒].
		'nG' => "\x03tv;\x05≫̸\x02g;\x05⋙̸\x02t;\x06≫⃒",
		// nLeftrightarrow;[⇎] nLeftarrow;[⇍] nLtv;[≪̸] nLl;[⋘̸] nLt;[≪⃒].
		'nL' => "\x0eeftrightarrow;\x03⇎\x09eftarrow;\x03⇍\x03tv;\x05≪̸\x02l;\x05⋘̸\x02t;\x06≪⃒",
		// nRightarrow;[⇏].
		'nR' => "\x0aightarrow;\x03⇏",
		// nVDash;[⊯] nVdash;[⊮].
		'nV' => "\x05Dash;\x03⊯\x05dash;\x03⊮",
		// naturals;[ℕ] napprox;[≉] natural;[♮] nacute;[ń] nabla;[∇] napid;[≋̸] napos;[ŉ] natur;[♮] nang;[∠⃒] napE;[⩰̸] nap;[≉].
		'na' => "\x07turals;\x03ℕ\x06pprox;\x03≉\x06tural;\x03♮\x05cute;\x02ń\x04bla;\x03∇\x04pid;\x05≋̸\x04pos;\x02ŉ\x04tur;\x03♮\x03ng;\x06∠⃒\x03pE;\x05⩰̸\x02p;\x03≉",
		// nbumpe;[≏̸] nbump;[≎̸] nbsp;[ ] nbsp[ ].
		'nb' => "\x05umpe;\x05≏̸\x04ump;\x05≎̸\x03sp;\x02 \x02sp\x02 ",
		// ncongdot;[⩭̸] ncaron;[ň] ncedil;[ņ] ncong;[≇] ncap;[⩃] ncup;[⩂] ncy;[н].
		'nc' => "\x07ongdot;\x05⩭̸\x05aron;\x02ň\x05edil;\x02ņ\x04ong;\x03≇\x03ap;\x03⩃\x03up;\x03⩂\x02y;\x02н",
		// ndash;[–].
		'nd' => "\x04ash;\x03–",
		// nearrow;[↗] nexists;[∄] nearhk;[⤤] nequiv;[≢] nesear;[⤨] nexist;[∄] neArr;[⇗] nearr;[↗] nedot;[≐̸] nesim;[≂̸] ne;[≠].
		'ne' => "\x06arrow;\x03↗\x06xists;\x03∄\x05arhk;\x03⤤\x05quiv;\x03≢\x05sear;\x03⤨\x05xist;\x03∄\x04Arr;\x03⇗\x04arr;\x03↗\x04dot;\x05≐̸\x04sim;\x05≂̸\x01;\x03≠",
		// nfr;[𝔫].
		'nf' => "\x02r;\x04𝔫",
		// ngeqslant;[⩾̸] ngeqq;[≧̸] ngsim;[≵] ngeq;[≱] nges;[⩾̸] ngtr;[≯] ngE;[≧̸] nge;[≱] ngt;[≯].
		'ng' => "\x08eqslant;\x05⩾̸\x04eqq;\x05≧̸\x04sim;\x03≵\x03eq;\x03≱\x03es;\x05⩾̸\x03tr;\x03≯\x02E;\x05≧̸\x02e;\x03≱\x02t;\x03≯",
		// nhArr;[⇎] nharr;[↮] nhpar;[⫲].
		'nh' => "\x04Arr;\x03⇎\x04arr;\x03↮\x04par;\x03⫲",
		// nisd;[⋺] nis;[⋼] niv;[∋] ni;[∋].
		'ni' => "\x03sd;\x03⋺\x02s;\x03⋼\x02v;\x03∋\x01;\x03∋",
		// njcy;[њ].
		'nj' => "\x03cy;\x02њ",
		// nleftrightarrow;[↮] nleftarrow;[↚] nleqslant;[⩽̸] nltrie;[⋬] nlArr;[⇍] nlarr;[↚] nleqq;[≦̸] nless;[≮] nlsim;[≴] nltri;[⋪] nldr;[‥] nleq;[≰] nles;[⩽̸] nlE;[≦̸] nle;[≰] nlt;[≮].
		'nl' => "\x0eeftrightarrow;\x03↮\x09eftarrow;\x03↚\x08eqslant;\x05⩽̸\x05trie;\x03⋬\x04Arr;\x03⇍\x04arr;\x03↚\x04eqq;\x05≦̸\x04ess;\x03≮\x04sim;\x03≴\x04tri;\x03⋪\x03dr;\x03‥\x03eq;\x03≰\x03es;\x05⩽̸\x02E;\x05≦̸\x02e;\x03≰\x02t;\x03≮",
		// nmid;[∤].
		'nm' => "\x03id;\x03∤",
		// notindot;[⋵̸] notinva;[∉] notinvb;[⋷] notinvc;[⋶] notniva;[∌] notnivb;[⋾] notnivc;[⋽] notinE;[⋹̸] notin;[∉] notni;[∌] nopf;[𝕟] not;[¬] not[¬].
		'no' => "\x07tindot;\x05⋵̸\x06tinva;\x03∉\x06tinvb;\x03⋷\x06tinvc;\x03⋶\x06tniva;\x03∌\x06tnivb;\x03⋾\x06tnivc;\x03⋽\x05tinE;\x05⋹̸\x04tin;\x03∉\x04tni;\x03∌\x03pf;\x04𝕟\x02t;\x02¬\x01t\x02¬",
		// nparallel;[∦] npolint;[⨔] npreceq;[⪯̸] nparsl;[⫽⃥] nprcue;[⋠] npart;[∂̸] nprec;[⊀] npar;[∦] npre;[⪯̸] npr;[⊀].
		'np' => "\x08arallel;\x03∦\x06olint;\x03⨔\x06receq;\x05⪯̸\x05arsl;\x06⫽⃥\x05rcue;\x03⋠\x04art;\x05∂̸\x04rec;\x03⊀\x03ar;\x03∦\x03re;\x05⪯̸\x02r;\x03⊀",
		// nrightarrow;[↛] nrarrc;[⤳̸] nrarrw;[↝̸] nrtrie;[⋭] nrArr;[⇏] nrarr;[↛] nrtri;[⋫].
		'nr' => "\x0aightarrow;\x03↛\x05arrc;\x05⤳̸\x05arrw;\x05↝̸\x05trie;\x03⋭\x04Arr;\x03⇏\x04arr;\x03↛\x04tri;\x03⋫",
		// nshortparallel;[∦] nsubseteqq;[⫅̸] nsupseteqq;[⫆̸] nshortmid;[∤] nsubseteq;[⊈] nsupseteq;[⊉] nsqsube;[⋢] nsqsupe;[⋣] nsubset;[⊂⃒] nsucceq;[⪰̸] nsupset;[⊃⃒] nsccue;[⋡] nsimeq;[≄] nsime;[≄] nsmid;[∤] nspar;[∦] nsubE;[⫅̸] nsube;[⊈] nsucc;[⊁] nsupE;[⫆̸] nsupe;[⊉] nsce;[⪰̸] nscr;[𝓃] nsim;[≁] nsub;[⊄] nsup;[⊅] nsc;[⊁].
		'ns' => "\x0dhortparallel;\x03∦\x09ubseteqq;\x05⫅̸\x09upseteqq;\x05⫆̸\x08hortmid;\x03∤\x08ubseteq;\x03⊈\x08upseteq;\x03⊉\x06qsube;\x03⋢\x06qsupe;\x03⋣\x06ubset;\x06⊂⃒\x06ucceq;\x05⪰̸\x06upset;\x06⊃⃒\x05ccue;\x03⋡\x05imeq;\x03≄\x04ime;\x03≄\x04mid;\x03∤\x04par;\x03∦\x04ubE;\x05⫅̸\x04ube;\x03⊈\x04ucc;\x03⊁\x04upE;\x05⫆̸\x04upe;\x03⊉\x03ce;\x05⪰̸\x03cr;\x04𝓃\x03im;\x03≁\x03ub;\x03⊄\x03up;\x03⊅\x02c;\x03⊁",
		// ntrianglerighteq;[⋭] ntrianglelefteq;[⋬] ntriangleright;[⋫] ntriangleleft;[⋪] ntilde;[ñ] ntilde[ñ] ntgl;[≹] ntlg;[≸].
		'nt' => "\x0frianglerighteq;\x03⋭\x0erianglelefteq;\x03⋬\x0driangleright;\x03⋫\x0criangleleft;\x03⋪\x05ilde;\x02ñ\x04ilde\x02ñ\x03gl;\x03≹\x03lg;\x03≸",
		// numero;[№] numsp;[ ] num;[#] nu;[ν].
		'nu' => "\x05mero;\x03№\x04msp;\x03 \x02m;\x01#\x01;\x02ν",
		// nvinfin;[⧞] nvltrie;[⊴⃒] nvrtrie;[⊵⃒] nvDash;[⊭] nvHarr;[⤄] nvdash;[⊬] nvlArr;[⤂] nvrArr;[⤃] nvsim;[∼⃒] nvap;[≍⃒] nvge;[≥⃒] nvgt;[>⃒] nvle;[≤⃒] nvlt;[<⃒].
		'nv' => "\x06infin;\x03⧞\x06ltrie;\x06⊴⃒\x06rtrie;\x06⊵⃒\x05Dash;\x03⊭\x05Harr;\x03⤄\x05dash;\x03⊬\x05lArr;\x03⤂\x05rArr;\x03⤃\x04sim;\x06∼⃒\x03ap;\x06≍⃒\x03ge;\x06≥⃒\x03gt;\x04>⃒\x03le;\x06≤⃒\x03lt;\x04<⃒",
		// nwarrow;[↖] nwarhk;[⤣] nwnear;[⤧] nwArr;[⇖] nwarr;[↖].
		'nw' => "\x06arrow;\x03↖\x05arhk;\x03⤣\x05near;\x03⤧\x04Arr;\x03⇖\x04arr;\x03↖",
		// oS;[Ⓢ].
		'oS' => "\x01;\x03Ⓢ",
		// oacute;[ó] oacute[ó] oast;[⊛].
		'oa' => "\x05cute;\x02ó\x04cute\x02ó\x03st;\x03⊛",
		// ocirc;[ô] ocir;[⊚] ocirc[ô] ocy;[о].
		'oc' => "\x04irc;\x02ô\x03ir;\x03⊚\x03irc\x02ô\x02y;\x02о",
		// odblac;[ő] odsold;[⦼] odash;[⊝] odiv;[⨸] odot;[⊙].
		'od' => "\x05blac;\x02ő\x05sold;\x03⦼\x04ash;\x03⊝\x03iv;\x03⨸\x03ot;\x03⊙",
		// oelig;[œ].
		'oe' => "\x04lig;\x02œ",
		// ofcir;[⦿] ofr;[𝔬].
		'of' => "\x04cir;\x03⦿\x02r;\x04𝔬",
		// ograve;[ò] ograve[ò] ogon;[˛] ogt;[⧁].
		'og' => "\x05rave;\x02ò\x04rave\x02ò\x03on;\x02˛\x02t;\x03⧁",
		// ohbar;[⦵] ohm;[Ω].
		'oh' => "\x04bar;\x03⦵\x02m;\x02Ω",
		// oint;[∮].
		'oi' => "\x03nt;\x03∮",
		// olcross;[⦻] olarr;[↺] olcir;[⦾] oline;[‾] olt;[⧀].
		'ol' => "\x06cross;\x03⦻\x04arr;\x03↺\x04cir;\x03⦾\x04ine;\x03‾\x02t;\x03⧀",
		// omicron;[ο] ominus;[⊖] omacr;[ō] omega;[ω] omid;[⦶].
		'om' => "\x06icron;\x02ο\x05inus;\x03⊖\x04acr;\x02ō\x04ega;\x02ω\x03id;\x03⦶",
		// oopf;[𝕠].
		'oo' => "\x03pf;\x04𝕠",
		// operp;[⦹] oplus;[⊕] opar;[⦷].
		'op' => "\x04erp;\x03⦹\x04lus;\x03⊕\x03ar;\x03⦷",
		// orderof;[ℴ] orslope;[⩗] origof;[⊶] orarr;[↻] order;[ℴ] ordf;[ª] ordm;[º] oror;[⩖] ord;[⩝] ordf[ª] ordm[º] orv;[⩛] or;[∨].
		'or' => "\x06derof;\x03ℴ\x06slope;\x03⩗\x05igof;\x03⊶\x04arr;\x03↻\x04der;\x03ℴ\x03df;\x02ª\x03dm;\x02º\x03or;\x03⩖\x02d;\x03⩝\x02df\x02ª\x02dm\x02º\x02v;\x03⩛\x01;\x03∨",
		// oslash;[ø] oslash[ø] oscr;[ℴ] osol;[⊘].
		'os' => "\x05lash;\x02ø\x04lash\x02ø\x03cr;\x03ℴ\x03ol;\x03⊘",
		// otimesas;[⨶] otilde;[õ] otimes;[⊗] otilde[õ].
		'ot' => "\x07imesas;\x03⨶\x05ilde;\x02õ\x05imes;\x03⊗\x04ilde\x02õ",
		// ouml;[ö] ouml[ö].
		'ou' => "\x03ml;\x02ö\x02ml\x02ö",
		// ovbar;[⌽].
		'ov' => "\x04bar;\x03⌽",
		// parallel;[∥] parsim;[⫳] parsl;[⫽] para;[¶] part;[∂] par;[∥] para[¶].
		'pa' => "\x07rallel;\x03∥\x05rsim;\x03⫳\x04rsl;\x03⫽\x03ra;\x02¶\x03rt;\x03∂\x02r;\x03∥\x02ra\x02¶",
		// pcy;[п].
		'pc' => "\x02y;\x02п",
		// pertenk;[‱] percnt;[%] period;[.] permil;[‰] perp;[⊥].
		'pe' => "\x06rtenk;\x03‱\x05rcnt;\x01%\x05riod;\x01.\x05rmil;\x03‰\x03rp;\x03⊥",
		// pfr;[𝔭].
		'pf' => "\x02r;\x04𝔭",
		// phmmat;[ℳ] phone;[☎] phiv;[ϕ] phi;[φ].
		'ph' => "\x05mmat;\x03ℳ\x04one;\x03☎\x03iv;\x02ϕ\x02i;\x02φ",
		// pitchfork;[⋔] piv;[ϖ] pi;[π].
		'pi' => "\x08tchfork;\x03⋔\x02v;\x02ϖ\x01;\x02π",
		// plusacir;[⨣] planckh;[ℎ] pluscir;[⨢] plussim;[⨦] plustwo;[⨧] planck;[ℏ] plankv;[ℏ] plusdo;[∔] plusdu;[⨥] plusmn;[±] plusb;[⊞] pluse;[⩲] plusmn[±] plus;[+].
		'pl' => "\x07usacir;\x03⨣\x06anckh;\x03ℎ\x06uscir;\x03⨢\x06ussim;\x03⨦\x06ustwo;\x03⨧\x05anck;\x03ℏ\x05ankv;\x03ℏ\x05usdo;\x03∔\x05usdu;\x03⨥\x05usmn;\x02±\x04usb;\x03⊞\x04use;\x03⩲\x04usmn\x02±\x03us;\x01+",
		// pm;[±].
		'pm' => "\x01;\x02±",
		// pointint;[⨕] pound;[£] popf;[𝕡] pound[£].
		'po' => "\x07intint;\x03⨕\x04und;\x02£\x03pf;\x04𝕡\x03und\x02£",
		// preccurlyeq;[≼] precnapprox;[⪹] precapprox;[⪷] precneqq;[⪵] precnsim;[⋨] profalar;[⌮] profline;[⌒] profsurf;[⌓] precsim;[≾] preceq;[⪯] primes;[ℙ] prnsim;[⋨] propto;[∝] prurel;[⊰] prcue;[≼] prime;[′] prnap;[⪹] prsim;[≾] prap;[⪷] prec;[≺] prnE;[⪵] prod;[∏] prop;[∝] prE;[⪳] pre;[⪯] pr;[≺].
		'pr' => "\x0aeccurlyeq;\x03≼\x0aecnapprox;\x03⪹\x09ecapprox;\x03⪷\x07ecneqq;\x03⪵\x07ecnsim;\x03⋨\x07ofalar;\x03⌮\x07ofline;\x03⌒\x07ofsurf;\x03⌓\x06ecsim;\x03≾\x05eceq;\x03⪯\x05imes;\x03ℙ\x05nsim;\x03⋨\x05opto;\x03∝\x05urel;\x03⊰\x04cue;\x03≼\x04ime;\x03′\x04nap;\x03⪹\x04sim;\x03≾\x03ap;\x03⪷\x03ec;\x03≺\x03nE;\x03⪵\x03od;\x03∏\x03op;\x03∝\x02E;\x03⪳\x02e;\x03⪯\x01;\x03≺",
		// pscr;[𝓅] psi;[ψ].
		'ps' => "\x03cr;\x04𝓅\x02i;\x02ψ",
		// puncsp;[ ].
		'pu' => "\x05ncsp;\x03 ",
		// qfr;[𝔮].
		'qf' => "\x02r;\x04𝔮",
		// qint;[⨌].
		'qi' => "\x03nt;\x03⨌",
		// qopf;[𝕢].
		'qo' => "\x03pf;\x04𝕢",
		// qprime;[⁗].
		'qp' => "\x05rime;\x03⁗",
		// qscr;[𝓆].
		'qs' => "\x03cr;\x04𝓆",
		// quaternions;[ℍ] quatint;[⨖] questeq;[≟] quest;[?] quot;[\"] quot[\"].
		'qu' => "\x0aaternions;\x03ℍ\x06atint;\x03⨖\x06esteq;\x03≟\x04est;\x01?\x03ot;\x01\"\x02ot\x01\"",
		// rAtail;[⤜] rAarr;[⇛] rArr;[⇒].
		'rA' => "\x05tail;\x03⤜\x04arr;\x03⇛\x03rr;\x03⇒",
		// rBarr;[⤏].
		'rB' => "\x04arr;\x03⤏",
		// rHar;[⥤].
		'rH' => "\x03ar;\x03⥤",
		// rationals;[ℚ] raemptyv;[⦳] rarrbfs;[⤠] rarrsim;[⥴] racute;[ŕ] rangle;[⟩] rarrap;[⥵] rarrfs;[⤞] rarrhk;[↪] rarrlp;[↬] rarrpl;[⥅] rarrtl;[↣] ratail;[⤚] radic;[√] rangd;[⦒] range;[⦥] raquo;[»] rarrb;[⇥] rarrc;[⤳] rarrw;[↝] ratio;[∶] race;[∽̱] rang;[⟩] raquo[»] rarr;[→].
		'ra' => "\x08tionals;\x03ℚ\x07emptyv;\x03⦳\x06rrbfs;\x03⤠\x06rrsim;\x03⥴\x05cute;\x02ŕ\x05ngle;\x03⟩\x05rrap;\x03⥵\x05rrfs;\x03⤞\x05rrhk;\x03↪\x05rrlp;\x03↬\x05rrpl;\x03⥅\x05rrtl;\x03↣\x05tail;\x03⤚\x04dic;\x03√\x04ngd;\x03⦒\x04nge;\x03⦥\x04quo;\x02»\x04rrb;\x03⇥\x04rrc;\x03⤳\x04rrw;\x03↝\x04tio;\x03∶\x03ce;\x05∽̱\x03ng;\x03⟩\x03quo\x02»\x03rr;\x03→",
		// rbrksld;[⦎] rbrkslu;[⦐] rbrace;[}] rbrack;[]] rbarr;[⤍] rbbrk;[❳] rbrke;[⦌].
		'rb' => "\x06rksld;\x03⦎\x06rkslu;\x03⦐\x05race;\x01}\x05rack;\x01]\x04arr;\x03⤍\x04brk;\x03❳\x04rke;\x03⦌",
		// rcaron;[ř] rcedil;[ŗ] rceil;[⌉] rcub;[}] rcy;[р].
		'rc' => "\x05aron;\x02ř\x05edil;\x02ŗ\x04eil;\x03⌉\x03ub;\x01}\x02y;\x02р",
		// rdldhar;[⥩] rdquor;[”] rdquo;[”] rdca;[⤷] rdsh;[↳].
		'rd' => "\x06ldhar;\x03⥩\x05quor;\x03”\x04quo;\x03”\x03ca;\x03⤷\x03sh;\x03↳",
		// realpart;[ℜ] realine;[ℛ] reals;[ℝ] real;[ℜ] rect;[▭] reg;[®] reg[®].
		're' => "\x07alpart;\x03ℜ\x06aline;\x03ℛ\x04als;\x03ℝ\x03al;\x03ℜ\x03ct;\x03▭\x02g;\x02®\x01g\x02®",
		// rfisht;[⥽] rfloor;[⌋] rfr;[𝔯].
		'rf' => "\x05isht;\x03⥽\x05loor;\x03⌋\x02r;\x04𝔯",
		// rharul;[⥬] rhard;[⇁] rharu;[⇀] rhov;[ϱ] rho;[ρ].
		'rh' => "\x05arul;\x03⥬\x04ard;\x03⇁\x04aru;\x03⇀\x03ov;\x02ϱ\x02o;\x02ρ",
		// rightleftharpoons;[⇌] rightharpoondown;[⇁] rightrightarrows;[⇉] rightleftarrows;[⇄] rightsquigarrow;[↝] rightthreetimes;[⋌] rightarrowtail;[↣] rightharpoonup;[⇀] risingdotseq;[≓] rightarrow;[→] ring;[˚].
		'ri' => "\x10ghtleftharpoons;\x03⇌\x0fghtharpoondown;\x03⇁\x0fghtrightarrows;\x03⇉\x0eghtleftarrows;\x03⇄\x0eghtsquigarrow;\x03↝\x0eghtthreetimes;\x03⋌\x0dghtarrowtail;\x03↣\x0dghtharpoonup;\x03⇀\x0bsingdotseq;\x03≓\x09ghtarrow;\x03→\x03ng;\x02˚",
		// rlarr;[⇄] rlhar;[⇌] rlm;[‏].
		'rl' => "\x04arr;\x03⇄\x04har;\x03⇌\x02m;\x03‏",
		// rmoustache;[⎱] rmoust;[⎱].
		'rm' => "\x09oustache;\x03⎱\x05oust;\x03⎱",
		// rnmid;[⫮].
		'rn' => "\x04mid;\x03⫮",
		// rotimes;[⨵] roplus;[⨮] roang;[⟭] roarr;[⇾] robrk;[⟧] ropar;[⦆] ropf;[𝕣].
		'ro' => "\x06times;\x03⨵\x05plus;\x03⨮\x04ang;\x03⟭\x04arr;\x03⇾\x04brk;\x03⟧\x04par;\x03⦆\x03pf;\x04𝕣",
		// rppolint;[⨒] rpargt;[⦔] rpar;[)].
		'rp' => "\x07polint;\x03⨒\x05argt;\x03⦔\x03ar;\x01)",
		// rrarr;[⇉].
		'rr' => "\x04arr;\x03⇉",
		// rsaquo;[›] rsquor;[’] rsquo;[’] rscr;[𝓇] rsqb;[]] rsh;[↱].
		'rs' => "\x05aquo;\x03›\x05quor;\x03’\x04quo;\x03’\x03cr;\x04𝓇\x03qb;\x01]\x02h;\x03↱",
		// rtriltri;[⧎] rthree;[⋌] rtimes;[⋊] rtrie;[⊵] rtrif;[▸] rtri;[▹].
		'rt' => "\x07riltri;\x03⧎\x05hree;\x03⋌\x05imes;\x03⋊\x04rie;\x03⊵\x04rif;\x03▸\x03ri;\x03▹",
		// ruluhar;[⥨].
		'ru' => "\x06luhar;\x03⥨",
		// rx;[℞].
		'rx' => "\x01;\x03℞",
		// sacute;[ś].
		'sa' => "\x05cute;\x02ś",
		// sbquo;[‚].
		'sb' => "\x04quo;\x03‚",
		// scpolint;[⨓] scaron;[š] scedil;[ş] scnsim;[⋩] sccue;[≽] scirc;[ŝ] scnap;[⪺] scsim;[≿] scap;[⪸] scnE;[⪶] scE;[⪴] sce;[⪰] scy;[с] sc;[≻].
		'sc' => "\x07polint;\x03⨓\x05aron;\x02š\x05edil;\x02ş\x05nsim;\x03⋩\x04cue;\x03≽\x04irc;\x02ŝ\x04nap;\x03⪺\x04sim;\x03≿\x03ap;\x03⪸\x03nE;\x03⪶\x02E;\x03⪴\x02e;\x03⪰\x02y;\x02с\x01;\x03≻",
		// sdotb;[⊡] sdote;[⩦] sdot;[⋅].
		'sd' => "\x04otb;\x03⊡\x04ote;\x03⩦\x03ot;\x03⋅",
		// setminus;[∖] searrow;[↘] searhk;[⤥] seswar;[⤩] seArr;[⇘] searr;[↘] setmn;[∖] sect;[§] semi;[;] sext;[✶] sect[§].
		'se' => "\x07tminus;\x03∖\x06arrow;\x03↘\x05arhk;\x03⤥\x05swar;\x03⤩\x04Arr;\x03⇘\x04arr;\x03↘\x04tmn;\x03∖\x03ct;\x02§\x03mi;\x01;\x03xt;\x03✶\x02ct\x02§",
		// sfrown;[⌢] sfr;[𝔰].
		'sf' => "\x05rown;\x03⌢\x02r;\x04𝔰",
		// shortparallel;[∥] shortmid;[∣] shchcy;[щ] sharp;[♯] shcy;[ш] shy;[­] shy[­].
		'sh' => "\x0cortparallel;\x03∥\x07ortmid;\x03∣\x05chcy;\x02щ\x04arp;\x03♯\x03cy;\x02ш\x02y;\x02­\x01y\x02­",
		// simplus;[⨤] simrarr;[⥲] sigmaf;[ς] sigmav;[ς] simdot;[⩪] sigma;[σ] simeq;[≃] simgE;[⪠] simlE;[⪟] simne;[≆] sime;[≃] simg;[⪞] siml;[⪝] sim;[∼].
		'si' => "\x06mplus;\x03⨤\x06mrarr;\x03⥲\x05gmaf;\x02ς\x05gmav;\x02ς\x05mdot;\x03⩪\x04gma;\x02σ\x04meq;\x03≃\x04mgE;\x03⪠\x04mlE;\x03⪟\x04mne;\x03≆\x03me;\x03≃\x03mg;\x03⪞\x03ml;\x03⪝\x02m;\x03∼",
		// slarr;[←].
		'sl' => "\x04arr;\x03←",
		// smallsetminus;[∖] smeparsl;[⧤] smashp;[⨳] smile;[⌣] smtes;[⪬︀] smid;[∣] smte;[⪬] smt;[⪪].
		'sm' => "\x0callsetminus;\x03∖\x07eparsl;\x03⧤\x05ashp;\x03⨳\x04ile;\x03⌣\x04tes;\x06⪬︀\x03id;\x03∣\x03te;\x03⪬\x02t;\x03⪪",
		// softcy;[ь] solbar;[⌿] solb;[⧄] sopf;[𝕤] sol;[/].
		'so' => "\x05ftcy;\x02ь\x05lbar;\x03⌿\x03lb;\x03⧄\x03pf;\x04𝕤\x02l;\x01/",
		// spadesuit;[♠] spades;[♠] spar;[∥].
		'sp' => "\x08adesuit;\x03♠\x05ades;\x03♠\x03ar;\x03∥",
		// sqsubseteq;[⊑] sqsupseteq;[⊒] sqsubset;[⊏] sqsupset;[⊐] sqcaps;[⊓︀] sqcups;[⊔︀] sqsube;[⊑] sqsupe;[⊒] square;[□] squarf;[▪] sqcap;[⊓] sqcup;[⊔] sqsub;[⊏] sqsup;[⊐] squf;[▪] squ;[□].
		'sq' => "\x09subseteq;\x03⊑\x09supseteq;\x03⊒\x07subset;\x03⊏\x07supset;\x03⊐\x05caps;\x06⊓︀\x05cups;\x06⊔︀\x05sube;\x03⊑\x05supe;\x03⊒\x05uare;\x03□\x05uarf;\x03▪\x04cap;\x03⊓\x04cup;\x03⊔\x04sub;\x03⊏\x04sup;\x03⊐\x03uf;\x03▪\x02u;\x03□",
		// srarr;[→].
		'sr' => "\x04arr;\x03→",
		// ssetmn;[∖] ssmile;[⌣] sstarf;[⋆] sscr;[𝓈].
		'ss' => "\x05etmn;\x03∖\x05mile;\x03⌣\x05tarf;\x03⋆\x03cr;\x04𝓈",
		// straightepsilon;[ϵ] straightphi;[ϕ] starf;[★] strns;[¯] star;[☆].
		'st' => "\x0eraightepsilon;\x02ϵ\x0araightphi;\x02ϕ\x04arf;\x03★\x04rns;\x02¯\x03ar;\x03☆",
		// succcurlyeq;[≽] succnapprox;[⪺] subsetneqq;[⫋] succapprox;[⪸] supsetneqq;[⫌] subseteqq;[⫅] subsetneq;[⊊] supseteqq;[⫆] supsetneq;[⊋] subseteq;[⊆] succneqq;[⪶] succnsim;[⋩] supseteq;[⊇] subedot;[⫃] submult;[⫁] subplus;[⪿] subrarr;[⥹] succsim;[≿] supdsub;[⫘] supedot;[⫄] suphsol;[⟉] suphsub;[⫗] suplarr;[⥻] supmult;[⫂] supplus;[⫀] subdot;[⪽] subset;[⊂] subsim;[⫇] subsub;[⫕] subsup;[⫓] succeq;[⪰] supdot;[⪾] supset;[⊃] supsim;[⫈] supsub;[⫔] supsup;[⫖] subnE;[⫋] subne;[⊊] supnE;[⫌] supne;[⊋] subE;[⫅] sube;[⊆] succ;[≻] sung;[♪] sup1;[¹] sup2;[²] sup3;[³] supE;[⫆] supe;[⊇] sub;[⊂] sum;[∑] sup1[¹] sup2[²] sup3[³] sup;[⊃].
		'su' => "\x0acccurlyeq;\x03≽\x0accnapprox;\x03⪺\x09bsetneqq;\x03⫋\x09ccapprox;\x03⪸\x09psetneqq;\x03⫌\x08bseteqq;\x03⫅\x08bsetneq;\x03⊊\x08pseteqq;\x03⫆\x08psetneq;\x03⊋\x07bseteq;\x03⊆\x07ccneqq;\x03⪶\x07ccnsim;\x03⋩\x07pseteq;\x03⊇\x06bedot;\x03⫃\x06bmult;\x03⫁\x06bplus;\x03⪿\x06brarr;\x03⥹\x06ccsim;\x03≿\x06pdsub;\x03⫘\x06pedot;\x03⫄\x06phsol;\x03⟉\x06phsub;\x03⫗\x06plarr;\x03⥻\x06pmult;\x03⫂\x06pplus;\x03⫀\x05bdot;\x03⪽\x05bset;\x03⊂\x05bsim;\x03⫇\x05bsub;\x03⫕\x05bsup;\x03⫓\x05cceq;\x03⪰\x05pdot;\x03⪾\x05pset;\x03⊃\x05psim;\x03⫈\x05psub;\x03⫔\x05psup;\x03⫖\x04bnE;\x03⫋\x04bne;\x03⊊\x04pnE;\x03⫌\x04pne;\x03⊋\x03bE;\x03⫅\x03be;\x03⊆\x03cc;\x03≻\x03ng;\x03♪\x03p1;\x02¹\x03p2;\x02²\x03p3;\x02³\x03pE;\x03⫆\x03pe;\x03⊇\x02b;\x03⊂\x02m;\x03∑\x02p1\x02¹\x02p2\x02²\x02p3\x02³\x02p;\x03⊃",
		// swarrow;[↙] swarhk;[⤦] swnwar;[⤪] swArr;[⇙] swarr;[↙].
		'sw' => "\x06arrow;\x03↙\x05arhk;\x03⤦\x05nwar;\x03⤪\x04Arr;\x03⇙\x04arr;\x03↙",
		// szlig;[ß] szlig[ß].
		'sz' => "\x04lig;\x02ß\x03lig\x02ß",
		// target;[⌖] tau;[τ].
		'ta' => "\x05rget;\x03⌖\x02u;\x02τ",
		// tbrk;[⎴].
		'tb' => "\x03rk;\x03⎴",
		// tcaron;[ť] tcedil;[ţ] tcy;[т].
		'tc' => "\x05aron;\x02ť\x05edil;\x02ţ\x02y;\x02т",
		// tdot;[⃛].
		'td' => "\x03ot;\x03⃛",
		// telrec;[⌕].
		'te' => "\x05lrec;\x03⌕",
		// tfr;[𝔱].
		'tf' => "\x02r;\x04𝔱",
		// thickapprox;[≈] therefore;[∴] thetasym;[ϑ] thicksim;[∼] there4;[∴] thetav;[ϑ] thinsp;[ ] thksim;[∼] theta;[θ] thkap;[≈] thorn;[þ] thorn[þ].
		'th' => "\x0aickapprox;\x03≈\x08erefore;\x03∴\x07etasym;\x02ϑ\x07icksim;\x03∼\x05ere4;\x03∴\x05etav;\x02ϑ\x05insp;\x03 \x05ksim;\x03∼\x04eta;\x02θ\x04kap;\x03≈\x04orn;\x02þ\x03orn\x02þ",
		// timesbar;[⨱] timesb;[⊠] timesd;[⨰] tilde;[˜] times;[×] times[×] tint;[∭].
		'ti' => "\x07mesbar;\x03⨱\x05mesb;\x03⊠\x05mesd;\x03⨰\x04lde;\x02˜\x04mes;\x02×\x03mes\x02×\x03nt;\x03∭",
		// topfork;[⫚] topbot;[⌶] topcir;[⫱] toea;[⤨] topf;[𝕥] tosa;[⤩] top;[⊤].
		'to' => "\x06pfork;\x03⫚\x05pbot;\x03⌶\x05pcir;\x03⫱\x03ea;\x03⤨\x03pf;\x04𝕥\x03sa;\x03⤩\x02p;\x03⊤",
		// tprime;[‴].
		'tp' => "\x05rime;\x03‴",
		// trianglerighteq;[⊵] trianglelefteq;[⊴] triangleright;[▹] triangledown;[▿] triangleleft;[◃] triangleq;[≜] triangle;[▵] triminus;[⨺] trpezium;[⏢] triplus;[⨹] tritime;[⨻] tridot;[◬] trade;[™] trisb;[⧍] trie;[≜].
		'tr' => "\x0eianglerighteq;\x03⊵\x0dianglelefteq;\x03⊴\x0ciangleright;\x03▹\x0biangledown;\x03▿\x0biangleleft;\x03◃\x08iangleq;\x03≜\x07iangle;\x03▵\x07iminus;\x03⨺\x07pezium;\x03⏢\x06iplus;\x03⨹\x06itime;\x03⨻\x05idot;\x03◬\x04ade;\x03™\x04isb;\x03⧍\x03ie;\x03≜",
		// tstrok;[ŧ] tshcy;[ћ] tscr;[𝓉] tscy;[ц].
		'ts' => "\x05trok;\x02ŧ\x04hcy;\x02ћ\x03cr;\x04𝓉\x03cy;\x02ц",
		// twoheadrightarrow;[↠] twoheadleftarrow;[↞] twixt;[≬].
		'tw' => "\x10oheadrightarrow;\x03↠\x0foheadleftarrow;\x03↞\x04ixt;\x03≬",
		// uArr;[⇑].
		'uA' => "\x03rr;\x03⇑",
		// uHar;[⥣].
		'uH' => "\x03ar;\x03⥣",
		// uacute;[ú] uacute[ú] uarr;[↑].
		'ua' => "\x05cute;\x02ú\x04cute\x02ú\x03rr;\x03↑",
		// ubreve;[ŭ] ubrcy;[ў].
		'ub' => "\x05reve;\x02ŭ\x04rcy;\x02ў",
		// ucirc;[û] ucirc[û] ucy;[у].
		'uc' => "\x04irc;\x02û\x03irc\x02û\x02y;\x02у",
		// udblac;[ű] udarr;[⇅] udhar;[⥮].
		'ud' => "\x05blac;\x02ű\x04arr;\x03⇅\x04har;\x03⥮",
		// ufisht;[⥾] ufr;[𝔲].
		'uf' => "\x05isht;\x03⥾\x02r;\x04𝔲",
		// ugrave;[ù] ugrave[ù].
		'ug' => "\x05rave;\x02ù\x04rave\x02ù",
		// uharl;[↿] uharr;[↾] uhblk;[▀].
		'uh' => "\x04arl;\x03↿\x04arr;\x03↾\x04blk;\x03▀",
		// ulcorner;[⌜] ulcorn;[⌜] ulcrop;[⌏] ultri;[◸].
		'ul' => "\x07corner;\x03⌜\x05corn;\x03⌜\x05crop;\x03⌏\x04tri;\x03◸",
		// umacr;[ū] uml;[¨] uml[¨].
		'um' => "\x04acr;\x02ū\x02l;\x02¨\x01l\x02¨",
		// uogon;[ų] uopf;[𝕦].
		'uo' => "\x04gon;\x02ų\x03pf;\x04𝕦",
		// upharpoonright;[↾] upharpoonleft;[↿] updownarrow;[↕] upuparrows;[⇈] uparrow;[↑] upsilon;[υ] uplus;[⊎] upsih;[ϒ] upsi;[υ].
		'up' => "\x0dharpoonright;\x03↾\x0charpoonleft;\x03↿\x0adownarrow;\x03↕\x09uparrows;\x03⇈\x06arrow;\x03↑\x06silon;\x02υ\x04lus;\x03⊎\x04sih;\x02ϒ\x03si;\x02υ",
		// urcorner;[⌝] urcorn;[⌝] urcrop;[⌎] uring;[ů] urtri;[◹].
		'ur' => "\x07corner;\x03⌝\x05corn;\x03⌝\x05crop;\x03⌎\x04ing;\x02ů\x04tri;\x03◹",
		// uscr;[𝓊].
		'us' => "\x03cr;\x04𝓊",
		// utilde;[ũ] utdot;[⋰] utrif;[▴] utri;[▵].
		'ut' => "\x05ilde;\x02ũ\x04dot;\x03⋰\x04rif;\x03▴\x03ri;\x03▵",
		// uuarr;[⇈] uuml;[ü] uuml[ü].
		'uu' => "\x04arr;\x03⇈\x03ml;\x02ü\x02ml\x02ü",
		// uwangle;[⦧].
		'uw' => "\x06angle;\x03⦧",
		// vArr;[⇕].
		'vA' => "\x03rr;\x03⇕",
		// vBarv;[⫩] vBar;[⫨].
		'vB' => "\x04arv;\x03⫩\x03ar;\x03⫨",
		// vDash;[⊨].
		'vD' => "\x04ash;\x03⊨",
		// vartriangleright;[⊳] vartriangleleft;[⊲] varsubsetneqq;[⫋︀] varsupsetneqq;[⫌︀] varsubsetneq;[⊊︀] varsupsetneq;[⊋︀] varepsilon;[ϵ] varnothing;[∅] varpropto;[∝] varkappa;[ϰ] varsigma;[ς] vartheta;[ϑ] vangrt;[⦜] varphi;[ϕ] varrho;[ϱ] varpi;[ϖ] varr;[↕].
		'va' => "\x0frtriangleright;\x03⊳\x0ertriangleleft;\x03⊲\x0crsubsetneqq;\x06⫋︀\x0crsupsetneqq;\x06⫌︀\x0brsubsetneq;\x06⊊︀\x0brsupsetneq;\x06⊋︀\x09repsilon;\x02ϵ\x09rnothing;\x03∅\x08rpropto;\x03∝\x07rkappa;\x02ϰ\x07rsigma;\x02ς\x07rtheta;\x02ϑ\x05ngrt;\x03⦜\x05rphi;\x02ϕ\x05rrho;\x02ϱ\x04rpi;\x02ϖ\x03rr;\x03↕",
		// vcy;[в].
		'vc' => "\x02y;\x02в",
		// vdash;[⊢].
		'vd' => "\x04ash;\x03⊢",
		// veebar;[⊻] vellip;[⋮] verbar;[|] veeeq;[≚] vert;[|] vee;[∨].
		've' => "\x05ebar;\x03⊻\x05llip;\x03⋮\x05rbar;\x01|\x04eeq;\x03≚\x03rt;\x01|\x02e;\x03∨",
		// vfr;[𝔳].
		'vf' => "\x02r;\x04𝔳",
		// vltri;[⊲].
		'vl' => "\x04tri;\x03⊲",
		// vnsub;[⊂⃒] vnsup;[⊃⃒].
		'vn' => "\x04sub;\x06⊂⃒\x04sup;\x06⊃⃒",
		// vopf;[𝕧].
		'vo' => "\x03pf;\x04𝕧",
		// vprop;[∝].
		'vp' => "\x04rop;\x03∝",
		// vrtri;[⊳].
		'vr' => "\x04tri;\x03⊳",
		// vsubnE;[⫋︀] vsubne;[⊊︀] vsupnE;[⫌︀] vsupne;[⊋︀] vscr;[𝓋].
		'vs' => "\x05ubnE;\x06⫋︀\x05ubne;\x06⊊︀\x05upnE;\x06⫌︀\x05upne;\x06⊋︀\x03cr;\x04𝓋",
		// vzigzag;[⦚].
		'vz' => "\x06igzag;\x03⦚",
		// wcirc;[ŵ].
		'wc' => "\x04irc;\x02ŵ",
		// wedbar;[⩟] wedgeq;[≙] weierp;[℘] wedge;[∧].
		'we' => "\x05dbar;\x03⩟\x05dgeq;\x03≙\x05ierp;\x03℘\x04dge;\x03∧",
		// wfr;[𝔴].
		'wf' => "\x02r;\x04𝔴",
		// wopf;[𝕨].
		'wo' => "\x03pf;\x04𝕨",
		// wp;[℘].
		'wp' => "\x01;\x03℘",
		// wreath;[≀] wr;[≀].
		'wr' => "\x05eath;\x03≀\x01;\x03≀",
		// wscr;[𝓌].
		'ws' => "\x03cr;\x04𝓌",
		// xcirc;[◯] xcap;[⋂] xcup;[⋃].
		'xc' => "\x04irc;\x03◯\x03ap;\x03⋂\x03up;\x03⋃",
		// xdtri;[▽].
		'xd' => "\x04tri;\x03▽",
		// xfr;[𝔵].
		'xf' => "\x02r;\x04𝔵",
		// xhArr;[⟺] xharr;[⟷].
		'xh' => "\x04Arr;\x03⟺\x04arr;\x03⟷",
		// xi;[ξ].
		'xi' => "\x01;\x02ξ",
		// xlArr;[⟸] xlarr;[⟵].
		'xl' => "\x04Arr;\x03⟸\x04arr;\x03⟵",
		// xmap;[⟼].
		'xm' => "\x03ap;\x03⟼",
		// xnis;[⋻].
		'xn' => "\x03is;\x03⋻",
		// xoplus;[⨁] xotime;[⨂] xodot;[⨀] xopf;[𝕩].
		'xo' => "\x05plus;\x03⨁\x05time;\x03⨂\x04dot;\x03⨀\x03pf;\x04𝕩",
		// xrArr;[⟹] xrarr;[⟶].
		'xr' => "\x04Arr;\x03⟹\x04arr;\x03⟶",
		// xsqcup;[⨆] xscr;[𝓍].
		'xs' => "\x05qcup;\x03⨆\x03cr;\x04𝓍",
		// xuplus;[⨄] xutri;[△].
		'xu' => "\x05plus;\x03⨄\x04tri;\x03△",
		// xvee;[⋁].
		'xv' => "\x03ee;\x03⋁",
		// xwedge;[⋀].
		'xw' => "\x05edge;\x03⋀",
		// yacute;[ý] yacute[ý] yacy;[я].
		'ya' => "\x05cute;\x02ý\x04cute\x02ý\x03cy;\x02я",
		// ycirc;[ŷ] ycy;[ы].
		'yc' => "\x04irc;\x02ŷ\x02y;\x02ы",
		// yen;[¥] yen[¥].
		'ye' => "\x02n;\x02¥\x01n\x02¥",
		// yfr;[𝔶].
		'yf' => "\x02r;\x04𝔶",
		// yicy;[ї].
		'yi' => "\x03cy;\x02ї",
		// yopf;[𝕪].
		'yo' => "\x03pf;\x04𝕪",
		// yscr;[𝓎].
		'ys' => "\x03cr;\x04𝓎",
		// yucy;[ю] yuml;[ÿ] yuml[ÿ].
		'yu' => "\x03cy;\x02ю\x03ml;\x02ÿ\x02ml\x02ÿ",
		// zacute;[ź].
		'za' => "\x05cute;\x02ź",
		// zcaron;[ž] zcy;[з].
		'zc' => "\x05aron;\x02ž\x02y;\x02з",
		// zdot;[ż].
		'zd' => "\x03ot;\x02ż",
		// zeetrf;[ℨ] zeta;[ζ].
		'ze' => "\x05etrf;\x03ℨ\x03ta;\x02ζ",
		// zfr;[𝔷].
		'zf' => "\x02r;\x04𝔷",
		// zhcy;[ж].
		'zh' => "\x03cy;\x02ж",
		// zigrarr;[⇝].
		'zi' => "\x06grarr;\x03⇝",
		// zopf;[𝕫].
		'zo' => "\x03pf;\x04𝕫",
		// zscr;[𝓏].
		'zs' => "\x03cr;\x04𝓏",
		// zwnj;[‌] zwj;[‍].
		'zw' => "\x03nj;\x03‌\x02j;\x03‍",
	),
	"GT\x00LT\x00gt\x00lt\x00",
	array(
		">",
		"<",
		">",
		"<",
	)
);
