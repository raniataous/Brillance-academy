/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@stripe/stripe-js/dist/stripe.esm.js":
/*!***********************************************************!*\
  !*** ./node_modules/@stripe/stripe-js/dist/stripe.esm.js ***!
  \***********************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   loadStripe: function() { return /* binding */ loadStripe; }
/* harmony export */ });
var V3_URL = 'https://js.stripe.com/v3';
var V3_URL_REGEX = /^https:\/\/js\.stripe\.com\/v3\/?(\?.*)?$/;
var EXISTING_SCRIPT_MESSAGE = 'loadStripe.setLoadParameters was called but an existing Stripe.js script already exists in the document; existing script parameters will be used';
var findScript = function findScript() {
  var scripts = document.querySelectorAll("script[src^=\"".concat(V3_URL, "\"]"));

  for (var i = 0; i < scripts.length; i++) {
    var script = scripts[i];

    if (!V3_URL_REGEX.test(script.src)) {
      continue;
    }

    return script;
  }

  return null;
};

var injectScript = function injectScript(params) {
  var queryString = params && !params.advancedFraudSignals ? '?advancedFraudSignals=false' : '';
  var script = document.createElement('script');
  script.src = "".concat(V3_URL).concat(queryString);
  var headOrBody = document.head || document.body;

  if (!headOrBody) {
    throw new Error('Expected document.body not to be null. Stripe.js requires a <body> element.');
  }

  headOrBody.appendChild(script);
  return script;
};

var registerWrapper = function registerWrapper(stripe, startTime) {
  if (!stripe || !stripe._registerWrapper) {
    return;
  }

  stripe._registerWrapper({
    name: 'stripe-js',
    version: "1.54.2",
    startTime: startTime
  });
};

var stripePromise = null;
var loadScript = function loadScript(params) {
  // Ensure that we only attempt to load Stripe.js at most once
  if (stripePromise !== null) {
    return stripePromise;
  }

  stripePromise = new Promise(function (resolve, reject) {
    if (typeof window === 'undefined' || typeof document === 'undefined') {
      // Resolve to null when imported server side. This makes the module
      // safe to import in an isomorphic code base.
      resolve(null);
      return;
    }

    if (window.Stripe && params) {
      console.warn(EXISTING_SCRIPT_MESSAGE);
    }

    if (window.Stripe) {
      resolve(window.Stripe);
      return;
    }

    try {
      var script = findScript();

      if (script && params) {
        console.warn(EXISTING_SCRIPT_MESSAGE);
      } else if (!script) {
        script = injectScript(params);
      }

      script.addEventListener('load', function () {
        if (window.Stripe) {
          resolve(window.Stripe);
        } else {
          reject(new Error('Stripe.js not available'));
        }
      });
      script.addEventListener('error', function () {
        reject(new Error('Failed to load Stripe.js'));
      });
    } catch (error) {
      reject(error);
      return;
    }
  });
  return stripePromise;
};
var initStripe = function initStripe(maybeStripe, args, startTime) {
  if (maybeStripe === null) {
    return null;
  }

  var stripe = maybeStripe.apply(undefined, args);
  registerWrapper(stripe, startTime);
  return stripe;
}; // eslint-disable-next-line @typescript-eslint/explicit-module-boundary-types

// own script injection.

var stripePromise$1 = Promise.resolve().then(function () {
  return loadScript(null);
});
var loadCalled = false;
stripePromise$1["catch"](function (err) {
  if (!loadCalled) {
    console.warn(err);
  }
});
var loadStripe = function loadStripe() {
  for (var _len = arguments.length, args = new Array(_len), _key = 0; _key < _len; _key++) {
    args[_key] = arguments[_key];
  }

  loadCalled = true;
  var startTime = Date.now();
  return stripePromise$1.then(function (maybeStripe) {
    return initStripe(maybeStripe, args, startTime);
  });
};




/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!*********************************!*\
  !*** ./assets/js/stripe-api.js ***!
  \*********************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _stripe_stripe_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @stripe/stripe-js */ "./node_modules/@stripe/stripe-js/dist/stripe.esm.js");
/**
 * Stripe js handle payment with form mount from Lib Stripe JS
 *
 * @since 4.0.2
 * @version 1.0.0
 */

const lpStripe = (() => {
  let Stripe;
  let elCheckoutForm;
  let elStripeForm, elPageCheckout;
  const idStripeForm = 'lp-stripe-payment-form';
  const idBtnPlaceHolder = 'learn-press-checkout-place-order';
  const idPageCheckout = 'learn-press-checkout';
  let urlHandle;
  let mountStripeDone = false;
  let errorMessage;
  const fetchAPI = function (args) {
    let callBack = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    fetch(urlHandle, {
      method: 'POST',
      /*headers: {
      	'X-WP-Nonce': lpGlobalSettings.nonce,
      },*/
      body: args
    }).then(res => res.text()).then(data => {
      data = LP.parseJSON(data);
      callBack.success(data);
    }).finally(() => {
      callBack.completed();
    }).catch(err => callBack.error(err));
  };

  /**
   * Load Stripe JS via publish key
   * then mount form Stripe
   *
   * @return {Promise<void>}
   */
  const mountFormStripe = async () => {
    try {
      Stripe = await (0,_stripe_stripe_js__WEBPACK_IMPORTED_MODULE_0__.loadStripe)(lpStripeSetting.publish_key || '');

      // Display form Stripe
      const options = {
        clientSecret: lpStripeSetting.publishableKey || '',
        appearance: {}
      };
      elStripeForm = Stripe.elements(options);

      // Create and mount the Payment Element
      const paymentElement = elStripeForm.create('payment');
      paymentElement.on('loaderror', function (event) {
        errorMessage = event.error.message;
      });
      paymentElement.on('ready', function (event) {
        mountStripeDone = true;
      });
      paymentElement.mount(`#${idStripeForm}`);
    } catch (error) {
      errorMessage = error.message;
    }
  };

  /**
   * Confirm the PaymentIntent with url has parameter "payment_intent"
   *
   * https://stripe.com/docs/js/payment_intents/confirm_payment
   *
   * @param  return_url
   * @param  callBack
   */
  const confirmStripePayment = (return_url, callBack) => {
    if (typeof Stripe === 'undefined') {
      console.log('Stripe is not defined');
    }
    if (typeof elStripeForm === 'undefined') {
      console.log('Stripe form not mounted');
    }
    Stripe.confirmPayment({
      elements: elStripeForm,
      confirmParams: {
        return_url
      }
    }).then(function (result) {
      callBack(result);
    });
  };
  const setMessageError = mess_text => {
    const elMessage = `<div class="learn-press-message error">${mess_text}</div>`;
    elPageCheckout.insertAdjacentHTML('afterbegin', elMessage);
    elPageCheckout.scrollIntoView({
      behavior: 'smooth'
    });
  };
  return {
    init: async () => {
      if ('undefined' === typeof lpStripeSetting) {
        console.log('LP Stripe Setting is not defined');
      }
      if ('undefined' === typeof lpStripeSetting.payment_stripe_via_iframe) {
        return;
      }
      elPageCheckout = document.getElementById(idPageCheckout);
      elCheckoutForm = document.getElementById('learn-press-checkout-form');
      if (!elCheckoutForm) {
        return;
      }
      await mountFormStripe();
    },
    events: () => {
      document.addEventListener('click', function (e) {
        const target = e.target;
        if (target.id === idBtnPlaceHolder) {
          const elBtnPlaceHolder = target;
          elCheckoutForm = document.getElementById('learn-press-checkout-form');
          if (!elCheckoutForm) {
            return;
          }
          const formData = new FormData(elCheckoutForm);
          if (formData.get('payment_method') !== 'stripe') {
            return;
          }
          e.preventDefault();
          if (!elPageCheckout) {
            console.error('Page checkout is not defined');
            return;
          }
          const elMes = elPageCheckout.querySelectorAll('.learn-press-message.error');
          if (elMes.length > 0) {
            elMes.forEach(el => {
              el.remove();
            });
          }
          if ('undefined' !== typeof errorMessage) {
            setMessageError(errorMessage);
            return;
          }
          if ('undefined' === typeof lpStripeSetting.publishableKey) {
            setMessageError('Stripe Publish Key is generate failed, please check again config key!');
            return;
          }
          if (!mountStripeDone) {
            setMessageError('Stripe payment not load done. Please wait!');
            return;
          }

          /**
           * Submit form Stripe to check valid fields
           * https://stripe.com/docs/js/elements/submit
           *
           * When check all fields is valid, will submit checkout to create order,
           * then pass url lp order to confirmStripePayment() to call Stripe API,
           * Stripe API will return url redirect has parameter "payment_intent",
           * server will catch it and check if payment_intent is valid, LP Order will set to Complete
           */
          elStripeForm.submit().then(function (result) {
            if ('undefined' !== typeof result.error) {
              return;
            }
            elBtnPlaceHolder.classList.add('loading');
            elBtnPlaceHolder.disabled = true;
            elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_processing;
            urlHandle = new URL(lpCheckoutSettings.ajaxurl);
            urlHandle.searchParams.set('lp-ajax', 'checkout');
            fetchAPI(formData, {
              before: () => {},
              success: res => {
                if ('fail' === res.result) {
                  elBtnPlaceHolder.classList.remove('loading');
                  elBtnPlaceHolder.disabled = false;
                  elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_place_order;
                  setMessageError(res.messages);
                } else if ('processing' === res.result) {
                  elBtnPlaceHolder.innerText = lpCheckoutSettings.i18n_redirecting;
                  confirmStripePayment(res.redirect, result => {
                    console.log(result);
                  });
                }
              },
              error: error => {},
              completed: () => {}
            });
          });
        }
      });
    }
  };
})();
document.addEventListener('DOMContentLoaded', () => {
  lpStripe.init().then(() => {});
});
lpStripe.events();
}();
/******/ })()
;
//# sourceMappingURL=stripe-api.js.map