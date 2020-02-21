<?php

namespace Astrotomic\Unavatar\Tests;

use Astrotomic\Unavatar\Unavatar;
use PHPUnit\Framework\TestCase;

final class UnavatarTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideUnavatarInputs
     */
    public function it_generates_unavatar_url(string $identifier, ?string $provider, string $expected): void
    {
        $unavatar = new Unavatar($identifier, $provider);

        static::assertSame($expected, $unavatar->toUrl());
        static::assertSame($expected, $unavatar->__toString());
        static::assertSame($expected, (string)$unavatar);
    }

    /**
     * @test
     * @dataProvider provideUnavatarInputs
     */
    public function it_generates_unavatar_img_tag(string $identifier, ?string $provider, string $expected): void
    {
        $unavatar = new Unavatar($identifier, $provider);

        if ($provider === null) {
            static::assertSame("<img alt=\"{$identifier}'s avatar\" src=\"{$expected}\" />", $unavatar->toImg());
        } else {
            static::assertSame("<img alt=\"{$identifier}'s {$provider} avatar\" src=\"{$expected}\" />", $unavatar->toImg());
        }
    }

    /**
     * @test
     * @dataProvider provideUnavatarInputs
     */
    public function it_can_apply_fallback_image(string $identifier, ?string $provider, string $expected): void
    {
        $unavatar = new Unavatar($identifier, $provider);
        $unavatar->fallback('https://api.adorable.io/avatars/256');

        static::assertSame($expected.'/?fallback=https%3A%2F%2Fapi.adorable.io%2Favatars%2F256', $unavatar->toUrl());
    }

    public function it_can_add_custom_attributes_to_image(): void
    {
        $unavatar = Unavatar::github('Gummibeer');

        static::assertSame(
            '<img alt="Gummibeer\'s github avatar" loading="lazy" src="https://unavatar.now.sh/github/Gummibeer" />',
            $unavatar->toImg(['loading' => 'lazy'])
        );
    }

    /**
     * @test
     * @dataProvider provideUnavatarProviders
     */
    public function it_can_use_provider_helpers(string $identifier, ?string $provider, string $expected): void
    {
        $unavatar = Unavatar::$provider($identifier);

        static::assertSame($expected, $unavatar->toUrl());
    }

    /** @test */
    public function it_can_use_username_helper(): void
    {
        $unavatar = Unavatar::username('Gummibeer');

        static::assertSame('https://unavatar.now.sh/Gummibeer', $unavatar->toUrl());
    }

    /** @test */
    public function it_can_use_email_helper(): void
    {
        $unavatar = Unavatar::email('dev.gummibeer@gmail.com');

        static::assertSame('https://unavatar.now.sh/dev.gummibeer%40gmail.com', $unavatar->toUrl());
    }

    /** @test */
    public function it_can_use_domain_helper(): void
    {
        $unavatar = Unavatar::domain('gummibeer.de');

        static::assertSame('https://unavatar.now.sh/gummibeer.de', $unavatar->toUrl());
    }

    public function provideUnavatarProviders(): array
    {
        return array_filter($this->provideUnavatarInputs(), fn($data) => $data[1] !== null);
    }

    public function provideUnavatarInputs(): array
    {
        return [
            ['Gummibeer', null, 'https://unavatar.now.sh/Gummibeer'],
            ['dev.gummibeer@gmail.com', null, 'https://unavatar.now.sh/dev.gummibeer%40gmail.com'],
            ['gummibeer.de', null, 'https://unavatar.now.sh/gummibeer.de'],
            ['Gummibeer', Unavatar::PROVIDER_GITHUB, 'https://unavatar.now.sh/github/Gummibeer'],
            ['tkwitkowski', Unavatar::PROVIDER_FACEBOOK, 'https://unavatar.now.sh/facebook/tkwitkowski'],
            ['dev.gummibeer@gmail.com', Unavatar::PROVIDER_GRAVATAR, 'https://unavatar.now.sh/gravatar/dev.gummibeer%40gmail.com'],
            ['dev.gummibeer', Unavatar::PROVIDER_INSTAGRAM, 'https://unavatar.now.sh/instagram/dev.gummibeer'],
            ['devgummibeer', Unavatar::PROVIDER_TWITTER, 'https://unavatar.now.sh/twitter/devgummibeer'],
            ['gummibeer', Unavatar::PROVIDER_TELEGRAM, 'https://unavatar.now.sh/telegram/gummibeer'],
            ['tkwitkowski', Unavatar::PROVIDER_SOUNDCLOUD, 'https://unavatar.now.sh/soundcloud/tkwitkowski'],
            ['xXx', Unavatar::PROVIDER_CLEARBIT, 'https://unavatar.now.sh/clearbit/xXx'],
            ['xXx', Unavatar::PROVIDER_DEVIANTART, 'https://unavatar.now.sh/deviantart/xXx'],
        ];
    }
}
