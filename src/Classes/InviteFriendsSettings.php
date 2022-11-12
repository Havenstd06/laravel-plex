<?php

namespace Havenstd06\LaravelPlex\Classes;

class InviteFriendsSettings
{
    protected bool $allowChannels = true;

    protected bool $allowSubtitleAdmin = true;

    protected string $allowSync = '';

    protected int $allowTuners = 0;

    protected string $filterMovies = '';

    protected string $filterMusic = '';

    protected string $filterTelevision = '';

    public function __construct(
        bool $allowChannels = true,
        bool $allowSubtitleAdmin = true,
        string $allowSync = '',
        int $allowTuners = 0,
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
     * @return bool
     */
    public function isAllowChannels(): bool
    {
        return $this->allowChannels;
    }

    /**
     * @param bool $allowChannels
     */
    public function setAllowChannels(bool $allowChannels): void
    {
        $this->allowChannels = $allowChannels;
    }

    /**
     * @return bool
     */
    public function isAllowSubtitleAdmin(): bool
    {
        return $this->allowSubtitleAdmin;
    }

    /**
     * @param bool $allowSubtitleAdmin
     */
    public function setAllowSubtitleAdmin(bool $allowSubtitleAdmin): void
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
     * @return int
     */
    public function isAllowTuners(): int
    {
        return $this->allowTuners;
    }

    /**
     * @param int $allowTuners
     */
    public function setAllowTuners(int $allowTuners): void
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