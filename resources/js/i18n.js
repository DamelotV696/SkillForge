import { createI18n } from 'vue-i18n'
import en from './lang/en.json'
import ru from './lang/ru.json'

export function createI18nInstance(locale = 'en') {
    return createI18n({
        legacy: false,
        locale,
        fallbackLocale: 'en',
        messages: { en, ru }
    })
}
