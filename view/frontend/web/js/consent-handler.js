/**
 * @category  Collab
 * @package   Collab\ConsentMode
 * @author    Marcin Jędrzejewski <m.jedrzejewski@collab.pl>
 * @copyright 2024 Collab
 * @license   MIT
 */

define([
    'jquery',
    'uiComponent',
    'mage/cookies'
], function ($, Component) {
    'use strict';

    return Component.extend({
        initialize: function (config) {
            this.moduleConfig = config || {};
            this.checkIfNeedsToDisplay();
            this.initInputsState();
            this.handleClicks(this.moduleConfig.buttons);
        },

        checkIfNeedsToDisplay: function () {
            const consentMode = JSON.parse(localStorage.getItem('consent-mode'));

            if (consentMode === null || $.mage.cookies.get(this.moduleConfig.cookieName) === null) {
                const blockSelector = this.moduleConfig.cookieBlock;
                document.getElementById(blockSelector).style.display = 'block';
            }
        },

        initInputsState: function () {
            const consentMode = JSON.parse(localStorage.getItem('consent-mode'));

            if (consentMode !== null) {
                document.getElementById(this.moduleConfig.consentBoxes.marketing).checked = consentMode.ad_storage === 'granted';
                document.getElementById(this.moduleConfig.consentBoxes.analytics).checked = consentMode.analytics_storage === 'granted';
                document.getElementById(this.moduleConfig.consentBoxes.preferences).checked = consentMode.personalization === 'granted';
            }
        },

        handleClicks: function (buttons) {
            for (const [key, value] of Object.entries(buttons)) {
                document.getElementById(value).addEventListener('click', function () {
                    this.handleButton(key);
                }.bind(this));
            }
        },

        handleButton: function (action) {
            const consent = {
                necessary: true,
                marketing: false,
                analytics: false,
                preferences: false
            };

            switch (action) {
                case 'allow':
                    for (const [key, value] of Object.entries(this.moduleConfig.consentBoxes)) {
                        consent[key] = document.getElementById(value).checked = true;
                    }
                    break;
                case 'reject':
                    window.location.href = this.moduleConfig.noCookiesUrl;
                    break;
                case 'partial':
                    this.handleNativeConsent();
                    for (const [key, value] of Object.entries(this.moduleConfig.consentBoxes)) {
                        consent[key] = document.getElementById(value).checked;
                    }
                    break;
                default:
                    break;
            }

            this.setConsent(consent);
        },

        handleNativeConsent: function () {
            const cookieExpires = new Date(new Date().getTime() + this.moduleConfig.cookieLifetime * 1000);
            const blockSelector = this.moduleConfig.cookieBlock;
            const mode = this.moduleConfig.mode || false;

            $.mage.cookies.set(this.moduleConfig.cookieName, JSON.stringify(this.moduleConfig.cookieValue), {
                expires: cookieExpires
            });

            if ($.mage.cookies.get(this.moduleConfig.cookieName)) {
                if (!mode) {
                    document.getElementById(blockSelector).style.display = 'none';
                }
                $(document).trigger('user:allowed:save:cookie');
            }
        },

        setConsent: function (consent) {
            const consentMode = {
                'functionality_storage': consent.necessary ? 'granted' : 'denied',
                'security_storage': consent.necessary ? 'granted' : 'denied',
                'ad_storage': consent.marketing ? 'granted' : 'denied',
                'analytics_storage': consent.analytics ? 'granted' : 'denied',
                'personalization': consent.preferences ? 'granted' : 'denied'
            };

            localStorage.setItem('consent-mode', JSON.stringify(consentMode));

            gtag('consent', 'update', consentMode);
        }
    });
});
