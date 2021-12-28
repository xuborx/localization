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

        if (!isset(self::$translations[$language][$key])) {
            throw new TranslationKeyNotFoundException(
              'Key ' . $key . ' not found for language code ' . $language,
              500
            );
        }

        return self::$translations[$language][$key];
    }

    /**
     * @param string $language
     * @return array
     */
    public static function getAll(string $language): array
    {
        self::store($language);
        return self::$translations[$language];
    }

    /**
     * @param string $language
     * @return void
     * @throws LocalizationFileNotFoundException
     */
    private static function store(string $language): void
    {
        if (!isset(self::$translations[$language])) {
            self::$translations = Parser::parse($language);
        }
    }
}
