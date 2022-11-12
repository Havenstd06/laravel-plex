<?php

namespace Havenstd06\LaravelPlex\Classes;

class InviteFriendsSettings
{
    protected string $allowChannels = '1';

    protected string $allowSubtitleAdmin = '1';

    protected string $allowSync = '0'; // Allow Downloads

    protected string $allowTuners = '0';

    protected string $filterMovies = '';

    protected string $filterMusic = '';

    protected string $filterTelevision = '';

    public function __construct(
        string $allowChannels = '1',
        string $allowSubtitleAdmin = '1',
        string $allowSync = '0',
        string $allowTuners = '0',
        string $filterMovies = '',
        string $filterMusic = '',
        string $filterTelevision = '',
    ) {
        $this->allowChannels = $allowChannels;
        $this->allowSubtitleAdmin = $allowSubtitleAdmin;
        $this->allowSync = $allowSync;
        $this->allowTuners = $allowTuners;
        $this->filterMovies = $filterMovies;
        $this->filterMusic = $filterMusic;
        $this->filterTelevision = $filterTelevision;
    }

    /**
     * @return string
     */
    public function isAllowChannels(): string
    {
        return $this->allowChannels;
    }

    /**
     * @param string $allowChannels
     */
    public function setAllowChannels(string $allowChannels): void
    {
        $this->allowChannels = $allowChannels;
    }

    /**
     * @return string
     */
    public function isAllowSubtitleAdmin(): string
    {
        return $this->allowSubtitleAdmin;
    }

    /**
     * @param string $allowSubtitleAdmin
     */
    public function setAllowSubtitleAdmin(string $allowSubtitleAdmin): void
    {
        $this->allowSubtitleAdmin = $allowSubtitleAdmin;
    }

    /**
     * @return string
     */
    public function isAllowSync(): string
    {
        return $this->allowSync;
    }

    /**
     * @param string $allowSync
     */
    public function setAllowSync(string $allowSync): void
    {
        $this->allowSync = $allowSync;
    }

    /**
     * @return string
     */
    public function isAllowTuners(): string
    {
        return $this->allowTuners;
    }

    /**
     * @param string $allowTuners
     */
    public function setAllowTuners(string $allowTuners): void
    {
        $this->allowTuners = $allowTuners;
    }

    /**
     * @return string
     */
    public function getFilterMovies(): string
    {
        return $this->filterMovies;
    }

    /**
     * @param string $filterMovies
     */
    public function setFilterMovies(string $filterMovies): void
    {
        $this->filterMovies = $filterMovies;
    }

    /**
     * @return string
     */
    public function getFilterMusic(): string
    {
        return $this->filterMusic;
    }

    /**
     * @param string $filterMusic
     */
    public function setFilterMusic(string $filterMusic): void
    {
        $this->filterMusic = $filterMusic;
    }

    /**
     * @return string
     */
    public function getFilterTelevision(): string
    {
        return $this->filterTelevision;
    }

    /**
     * @param string $filterTelevision
     */
    public function setFilterTelevision(string $filterTelevision): void
    {
        $this->filterTelevision = $filterTelevision;
    }

    public function toArray(): array
    {
        return [
            'allowChannels' => $this->isAllowChannels(),
            'allowSubtitleAdmin' => $this->isAllowSubtitleAdmin(),
            'allowSync' => $this->isAllowSync(),
            'allowTuners' => $this->isAllowTuners(),
            'filterMovies' => $this->getFilterMovies(),
            'filterMusic' => $this->getFilterMusic(),
            'filterTelevision' => $this->getFilterTelevision(),
        ];
    }
}