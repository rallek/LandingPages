# TRANSLATION INSTRUCTIONS

To create a new translation follow the steps below:

1. First install the module like described in the `install.md` file.
2. Open a console and navigate to the Zikula root directory.
3. Execute this command replacing `en` by your desired locale code:

`php bin/console translation:extract en --bundle=RKLandingPagesModule --enable-extractor=jms_i18n_routing --output-format=po`

You can also use multiple locales at once, for example `de fr es`.

4. Translate the resulting `.po` files in `modules/RK/LandingPagesModule/Resources/translations/` using your favourite Gettext tooling.

Note you can even include custom views in `app/Resources/RKLandingPagesModule/views/` and JavaScript files in `app/Resources/RKLandingPagesModule/public/js/` like this:

`php bin/console translation:extract en --bundle=RKLandingPagesModule --enable-extractor=jms_i18n_routing --output-format=po --dir=./modules/RK/LandingPagesModule --dir=./app/Resources/RKLandingPagesModule`

For questions and other remarks visit our homepage http://k62.de.

Ralf Koester (ralf@familie-koester.de)
http://k62.de
