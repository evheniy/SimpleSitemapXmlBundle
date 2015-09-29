<?php

namespace Evheniy\SitemapXmlBundle\Dump;

use Evheniy\SitemapXmlBundle\Exception\DumpException;

/**
 * Class DumpManager
 * @package Evheniy\SitemapXmlBundle\Dump
 */
class DumpManager
{
    /**
     * @var string
     */
    protected $webDir;
    /**
     * @var string
     */
    protected $path = '';
    /**
     * @var bool
     */
    protected $isCarefully = false;
    /**
     * @var string
     */
    protected $protocol = 'http';
    /**
     * @var string
     */
    protected $domain;
    /**
     * @var SiteMapIndexEntity
     */
    protected $siteMapIndexEntity;
    /**
     * @var SiteMapEntity
     */
    protected $siteMapEntity;

    /**
     * @param string $webDir
     */
    public function __construct($webDir)
    {
        $this->webDir = $webDir;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath($path = '')
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param bool|false $isCarefully
     *
     * @return $this
     */
    public function setCarefully($isCarefully = false)
    {
        $this->isCarefully = $isCarefully;

        return $this;
    }

    /**
     * @param string $protocol
     *
     * @return $this
     * @throws DumpException
     */
    public function setProtocol($protocol = 'http')
    {
        if (!in_array($protocol, array('http', 'https'))) {
            throw new DumpException('Wrong protocol!');
        }
        $this->protocol = $protocol;

        return $this;
    }

    /**
     * @param string $domain
     *
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * @param SiteMapIndexEntity $siteMapIndexEntity
     *
     * @return $this
     */
    public function setSiteMapIndexEntity(SiteMapIndexEntity $siteMapIndexEntity)
    {
        $this->siteMapIndexEntity = $siteMapIndexEntity;

        return $this;
    }

    /**
     * @param SiteMapEntity $siteMapEntity
     *
     * @return $this
     */
    public function setSiteMapEntity(SiteMapEntity $siteMapEntity)
    {
        $this->siteMapEntity = $siteMapEntity;

        return $this;
    }

    /**
     * @throws DumpException
     */
    public function dumpSiteMapIndex()
    {
        $this->validateDomain();
        $this->validateSiteMapIndex();
        $this->validateAllSiteMap();
        $this->saveSiteMap();
        $this->saveSiteMapIndex();
    }

    /**
     * @throws DumpException
     */
    public function dumpSiteMap()
    {
        $this->validateDomain();
        $this->validateSiteMap();
        $this->saveSiteMap();
    }

    /**
     * @throws DumpException
     */
    protected function validateDomain()
    {
        if (empty($this->domain)) {
            throw new DumpException('Empty domain!');
        }
    }

    /**
     * @throws DumpException
     */
    protected function validateSiteMapIndex()
    {
        if (empty($this->siteMapIndexEntity)) {
            throw new DumpException('Empty SiteMapIndexEntity!');
        }
    }

    /**
     * @throws DumpException
     */
    protected function validateSiteMap()
    {
        if (empty($this->siteMapEntity)) {
            throw new DumpException('Empty SiteMapEntity!');
        }
    }

    /**
     *
     */
    protected function setSiteMapLocation()
    {
        $counter = 0;
        foreach ($this->siteMapIndexEntity->getSiteMapCollection() as $siteMapEntity) {
            $loc = $siteMapEntity->getLoc();
            if (empty($loc)) {
                $siteMapEntity->setLoc($this->protocol . '://' . $this->domain . '/' . $this->path . '/' . 'sitemap' . $counter++ . '.xml');
            }
        }
    }

    /**
     * @throws \Evheniy\SitemapXmlBundle\Exception\ValidateEntityException
     */
    protected function validateAllSiteMap()
    {
        $this->siteMapIndexEntity->validate();
    }

    /**
     *
     */
    protected function saveSiteMap()
    {
        foreach ($this->siteMapIndexEntity->getSiteMapCollection() as $siteMapEntity) {
            $this->saveFile($siteMapEntity->getLoc(), $siteMapEntity->getXml());
        }

    }

    /**
     *
     */
    protected function saveSiteMapIndex()
    {
        $this->saveFile($this->path . '/' . 'sitemap.xml', $this->siteMapIndexEntity->getXml());
    }

    /**
     * @param string $filePath
     * @param string $fileContent
     */
    protected function saveFile($filePath, $fileContent)
    {
        $filePath;
        $fileContent;
        //TODO save file
    }
}