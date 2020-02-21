<?php

namespace Astrotomic\Unavatar;

class Unavatar
{
    public const PROVIDER_GITHUB = 'github';
    public const PROVIDER_FACEBOOK = 'facebook';
    public const PROVIDER_GRAVATAR = 'gravatar';
    public const PROVIDER_INSTAGRAM = 'instagram';
    public const PROVIDER_TWITTER = 'twitter';
    public const PROVIDER_TELEGRAM = 'telegram';
    public const PROVIDER_SOUNDCLOUD = 'soundcloud';
    public const PROVIDER_CLEARBIT = 'clearbit';
    public const PROVIDER_DEVIANTART = 'deviantart';

    protected const BASE_URL = 'https://unavatar.now.sh';

    protected string $identifier;
    protected ?string $provider = null;
    protected ?string $fallback = null;

    public static function username(string $username): self
    {
        return new static($username);
    }

    public static function email(string $email): self
    {
        return new static($email);
    }

    public static function domain(string $domain): self
    {
        return new static($domain);
    }

    public static function github(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_GITHUB);
    }

    public static function facebook(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_FACEBOOK);
    }

    public static function gravatar(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_GRAVATAR);
    }

    public static function instagram(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_INSTAGRAM);
    }

    public static function twitter(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_TWITTER);
    }

    public static function telegram(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_TELEGRAM);
    }

    public static function soundcloud(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_SOUNDCLOUD);
    }

    public static function clearbit(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_CLEARBIT);
    }

    public static function deviantart(string $identifier): self
    {
        return new static($identifier, self::PROVIDER_DEVIANTART);
    }

    public function __construct(string $identifier, ?string $provider = null)
    {
        $this->identifier = $identifier;
        $this->provider = $provider;
    }

    public function fallback(string $fallback): self
    {
        $this->fallback = $fallback;

        return $this;
    }

    public function toImg(array $attr = []): string
    {
        $attr = array_merge([
            'alt' => implode(' ', array_filter([$this->identifier.'\'s', $this->provider, 'avatar']))
        ], $attr);

        $attr['src'] = $this->toUrl();

        return sprintf('<img %s />', implode(' ', array_map(
            fn ($k, $v) => sprintf('%s="%s"', $k, htmlspecialchars($v)),
            array_keys($attr), $attr
        )));
    }

    public function toUrl(): string
    {
        return implode('/', array_filter([
            static::BASE_URL,
            $this->provider,
            urlencode($this->identifier),
            ($this->fallback === null ? '' : '?fallback='.urlencode($this->fallback)),
        ]));
    }

    public function __toString(): string
    {
        return $this->toUrl();
    }
}
