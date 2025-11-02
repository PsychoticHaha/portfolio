const appTranslations = window.APP_I18N || {};

const defaultHeroRoles = [
  'an Expert Front-End Developer',
  'a UI/UX Designer',
  'a Professional Web Integrator',
  'a React.js / Next.js Developer',
  'a WordPress Developer'
];

const defaultMessages = {
  formInvalid: 'Please provide a valid email and a message with at least 6 characters.',
  thanksMessage: 'Thanks for your message!',
  formError: 'Sorry, I could not send your message. Please try again later.',
  verificationUnavailable: 'Verification service is unavailable. Please reload the page.',
  verificationFailed: 'Verification failed. Please try again.',
  feedbackPrompt: 'Please tell me a little bit more so I can improve.',
  feedbackThanks: 'Thanks for the feedback!',
  feedbackError: 'Unable to save your feedback right now.',
  reactionError: 'Unable to save your reaction.'
};

export const heroRoles = Array.isArray(appTranslations.heroRoles) && appTranslations.heroRoles.length
  ? appTranslations.heroRoles
  : defaultHeroRoles;

export const messages = {
  ...defaultMessages,
  ...(appTranslations.messages && typeof appTranslations.messages === 'object'
    ? appTranslations.messages
    : {})
};

export function getAppTranslations() {
  return appTranslations;
}
