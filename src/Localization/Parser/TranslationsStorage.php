<?php
declare(strict_types=1);

namespace Xuborx\Localization\Parser;

use Xuborx\Localization\Exceptions\LocalizationFileNotFoundException;
use Xuborx\Localization\Exceptions\TranslationKeyNotFoundException;

class TranslationsStorage
{
    /**
     * @var array|null
     */
    private static $translations = null;

    /**
     * @param string $key
     * @param string $language
     * @return string
     * @throws TranslationKeyNotFoundException
     */
    public static function get(string $key, string $language): string
    {
        self::store($language);

        if (!isset(self::$translations[$key])) {
            throw new TranslationKeyNotFoundException(
              'Key ' . $key . ' not found',
              500
            );
        }

        return self::$translations[$key];
    }

    /**
     * @param string $language
     * @return array
     */
    public static function getAll(string $language): array
    {
        self::store($language);
        return self::$translations;
    }

    /**
     * @param string $language
     * @return void
     * @throws LocalizationFileNotFoundException
     */
    private static function store(string $language): void
    {
        if (empty(self::$translations)) {
            self::$translations = Parser::parse($language);
        }
    }
}
