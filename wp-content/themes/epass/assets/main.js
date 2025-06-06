import 'vite/modulepreload-polyfill'
import FlyntComponent from './scripts/FlyntComponent'
import './scripts/scroll-position-classes'
import './scripts/dc-accordions'
import './scripts/anchor-scroll'

import 'lazysizes'

if (import.meta.env.DEV) {
  import('@vite/client')
}

import.meta.glob([
  '../Components/**',
  '../assets/**',
  '!**/*.js',
  '!**/*.scss',
  '!**/*.php',
  '!**/*.twig',
  '!**/screenshot.png',
  '!**/*.md'
])

window.customElements.define(
  'flynt-component',
  FlyntComponent
)
