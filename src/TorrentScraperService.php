<?php

namespace Xurumelous\TorrentScraper;

class TorrentScraperService
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    public function __construct($adapter, $options = [])
    {
        $adapterName = __NAMESPACE__ . '\\Adapter\\' . ucfirst($adapter) . 'Adapter';
        $this->setAdapter(new $adapterName($options));
    }

    public function setAdapter(AdapterInterface $adapter)
    {
        if (!$adapter->getHttpClient())
        {
            $adapter->setHttpClient(new \GuzzleHttp\Client());
        }

        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function search($query)
    {
        return $this->adapter->search($query);
    }
}
