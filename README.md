SimpleSitemapXmlBundle
=================

This bundle provides sitemap.xml generator for Symfony2

Installation
------------

    $ composer require evheniy/simple-sitemap-xml-bundle "1.*"

Or add to composer.json

    "evheniy/simple-sitemap-xml-bundle": "1.*"

AppKernel:

    public function registerBundles()
        {
            $bundles = array(
                ...
                new Evheniy\SimpleSitemapXmlBundle\SimpleSitemapXmlBundle(),
            );
            ...


    ...

The last step

    app/console manifest:dump

Documentation
-------------



License
-------

This bundle is under the [MIT][3] license.

[Документация на русском языке][1]

[Demo][2] - Open page, then turn off network and update page

[Build a sitemap][4]

[1]:  http://makedev.org/articles/symfony/bundles/simple_sitemap_xml_bundle.html
[2]:  http://makedev.org/sitemap.xml
[3]:  https://github.com/evheniy/SimpleSitemapXmlBundle/blob/master/Resources/meta/LICENSE
[4]:  https://support.google.com/webmasters/answer/183668
