<?php
declare(strict_types=1);

namespace Xuborx\Localization\Parser;

use Xuborx\Localization\Exceptions\LocalizationFileNotFoundException;

class Parser
{

    /**
     * @param string $language
     * @return array
     * @throws LocalizationFileNotFoundException
     */
    public static function parse(string $language): array
    {
        $localizationFile = file_get_contents(XU_TRANSLATIONS_FILES_DIR . '/' . $language . '.xulocal');

        if ($localizationFile === false) {
            throw new LocalizationFileNotFoundException(
                'Localization file ' . $language . '.xulocal not found',
                500
            );
        }

        return self::convertFileToKeyValue($localizationFile);
    }

    /**
     * @param string $fileContent
     * @return array
     */
    private static function convertFileToKeyValue(string $fileContent): array
    {
        $translationsStrings = explode("\n", $fileContent);
        $translationsStrings = array_filter($translationsStrings);

        $translationsKeyValue = [];

        if (!empty($fileContent)) {
            foreach ($translationsStrings as $string) {
                $string = trim($string);
                $key = strtok($string, '=');
                $value = substr($string, strpos($string, "=") + 1);
                $translationsKeyValue[$key] = $value;
            }
        }

        return $translationsKeyValue;
    }

}
