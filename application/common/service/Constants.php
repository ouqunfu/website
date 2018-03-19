<?php

namespace app\common\service;
/**
 * 常量定义
 *
 */

class Constants
{
    //sign in session expire time
    const TIME_DAY = 24 * 3600 * 1;

    //sign in channel user expire time
    const CHANNEL_TIME_DAY = 24 * 3600 * 1;

    //block campaign statistic limit time
    const BLOCK_CAMPAIGN_TIME_DAY = 24 * 3600 * 1;

    //limit upload file size 2Mb
    const MAX_UPLOAD_FILE_SIZE = 20 * 1024 * 1024;
    //limit upload file ext
    const UPLOAD_FILE_EXT = 'pdf,doc,docx';

    //status
    const STATUS_ACTIVE = 'active';
    const STATUS_PAUSED = 'paused';
    const STATUS_PENDING = 'pending';

    //'processing','paid'
    const STATUS_PROCESSING = 'processing';
    const STATUS_PAID = 'paid';

    //channel type
    const CHANNEL_TYPE_API_CHANNEL = 'api_channel';
    const CHANNEL_TYPE_API_PUBLISHER = 'api_publisher';
    const CHANNEL_TYPE_TRAFFIC_SOURCE = 'traffic_source';
    const CHANNEL_TYPE_MEDIA_CHANNEL = 'media_channel';

    //account level
    const ACCOUNT_LEVEL_A = 'a';
    const ACCOUNT_LEVEL_B = 'b';
    const ACCOUNT_LEVEL_C = 'c';
    const ACCOUNT_LEVEL_D = 'd';
    const ACCOUNT_LEVEL_E = 'e';

    //deduct first
    const DEDUCT_FIRST_YES = 'yes';
    const DEDUCT_FIRST_NO = 'no';


    //error code
    //1XX表示客户端的错误，2XX表示服务端的错误
    //1xx client error, 2xx server error
    const ERROR_OBJECT_NOT_EXIST = 100;
    const ERROR_STATUS_ERROR = 101;
    const ERROR_LOGIN = 102;
    const ERROR_PARAMS = 103;
    const ERROR_REPEAT = 104;

    const ERROR_SERVER = 200;
    const ERROR_ACCESS = 201;

    const ERROR_OK = 0;

    //http action
    const HTTP_GET = 'get';
    const HTTP_POST = 'post';
    const HTTP_PUT = 'put';
    const HTTP_DELETE = 'delete';

    //pageSize
    const PAGE_SIZE = 50;

    //限制date range 查询范围 单位天
    const DATE_RANGE = 31;

    //file 缓存过期时间 expire time 15 minutes
    const FILE_CACHE_EXPIRE_TIME = 5 * 60;
    //minutes statistic data D-value scale
    const STATS_DIFF_SCALE = 0.5;
    //查询入库时间为3分钟前
    const CHECK_LOADING_TIME = 3 * 60;

    //国家key => value 数组
    const COUNTRY_ARRAY = [
        'AL' => 'Albania',
        'DZ' => 'Algeria',
        'AF' => 'Afghanistan',
        'AR' => 'Argentina',
        'AE' => 'United Arab Emirates',
        'AW' => 'Aruba',
        'OM' => 'Oman',
        'AZ' => 'Azerbaijan',
        'EG' => 'Egypt',
        'ET' => 'Ethiopia',
        'IE' => 'Ireland',
        'EE' => 'Estonia',
        'AD' => 'Andorra',
        'AO' => 'Angola',
        'AI' => 'Anguilla',
        'AG' => 'Antigua and barbuda',
        'AT' => 'Austria',
        'AU' => 'Australia',
        'MO' => 'Macau',
        'BB' => 'Barbados',
        'PG' => 'Papua New Guinea',
        'BS' => 'Bahamas',
        'PK' => 'Pakistan',
        'PY' => 'Paraguay',
        'PS' => 'Palestine',
        'BH' => 'Bahrain',
        'PA' => 'Panama',
        'BR' => 'Brazil',
        'BY' => 'Belarus',
        'BM' => 'Bermuda',
        'BG' => 'Bulgaria',
        'MP' => 'Northern Marianas Islands',
        'BJ' => 'Benin',
        'BE' => 'Belgium',
        'IS' => 'Iceland',
        'PR' => 'Puerto Rico',
        'BA' => 'Bosnia and Herzegovina',
        'PL' => 'Poland',
        'BO' => 'Bolivia',
        'BZ' => 'Belize',
        'BW' => 'Botswana',
        'BT' => 'Bhutan ',
        'BF' => 'Burkina Faso',
        'BI' => 'Burundi',
        'BV' => 'Bouvet Island',
        'KP' => 'Korea Democratic Peoples Republic of',
        'GQ' => 'Equatorial Guinea',
        'DK' => 'Denmark',
        'DE' => 'Germany',
        'TP' => 'East Timor',
        'TG' => 'Togo',
        'DO' => 'Dominican Republic',
        'DM' => 'Dominica',
        'RU' => 'Russia',
        'EC' => 'Ecuador',
        'ER' => 'Eritrea',
        'FR' => 'France',
        'FO' => 'Faroe Islands',
        'PF' => 'French Polynesia',
        'GF' => 'French Guiana',
        'TF' => 'French Southern Territories',
        'VA' => 'Vatican',
        'PH' => 'Philippines',
        'FJ' => 'Fiji',
        'FI' => 'Finland',
        'CV' => 'Cape Verde',
        'FK' => 'Falkland Islands ',
        'GM' => 'Gambia',
        'CG' => 'Congo',
        'CD' => 'Congo the democratic republic of the ',
        'CO' => 'Columbia',
        'CR' => 'Costa Rica',
        'GD' => 'Grenada',
        'GL' => 'Greenland',
        'GE' => 'Georgia',
        'CU' => 'Cuba',
        'GP' => 'Guadeloupe',
        'GU' => 'Guam',
        'GY' => 'Guyana',
        'KZ' => 'Kazakstan',
        'HT' => 'Haiti',
        'KR' => 'Korea Republic of',
        'NL' => 'Netherlands',
        'AN' => 'Netherlands Antilles',
        'HM' => 'Heard Islands and McDonald Islands ',
        'HN' => 'Honduras',
        'KI' => 'Kiribati',
        'DJ' => 'Djibouti',
        'KG' => 'Kyrgyzstan',
        'GN' => 'Guinea',
        'GW' => 'Guinea-bissau',
        'CA' => 'Canada',
        'GH' => 'Ghana',
        'GA' => 'Gabon',
        'KH' => 'Cambodia',
        'CZ' => 'Czech Republic',
        'ZW' => 'Zimbabwe',
        'CM' => 'Cameroon',
        'QA' => 'Qatar',
        'KY' => 'Cayman Islands',
        'CC' => 'Coccs',
        'KM' => 'Comoros',
        'CI' => 'Cote dIvoire',
        'KW' => 'Kuwait',
        'HR' => 'Croatia',
        'KE' => 'Kenya',
        'CK' => 'Cook Islands',
        'LV' => 'Latvia',
        'LS' => 'Lesotho',
        'LA' => 'Lao',
        'LB' => 'Lebanon',
        'LT' => 'Lithuania',
        'LR' => 'Liberia',
        'LY' => 'Libya',
        'LI' => 'Liechtenstein',
        'RE' => 'Reunion',
        'LU' => 'Luxembourg',
        'RW' => 'Rwanda',
        'RO' => 'Romania',
        'MG' => 'Madagascar',
        'MV' => 'Maldives',
        'MT' => 'Malta',
        'MW' => 'Malawi',
        'MY' => 'Malaysia',
        'ML' => 'Mali',
        'MH' => 'Marshall Islands',
        'MQ' => 'Martinique',
        'YT' => 'Mayotte',
        'MU' => 'Mauritius',
        'MR' => 'Mauritania',
        'US' => 'United States',
        'UM' => 'United States Minor outlying Islands',
        'AS' => 'American Samoa',
        'VI' => 'Virgin Islands U.S.',
        'MN' => 'Mongolia',
        'MS' => 'Montserrat',
        'BD' => 'Bangladesh',
        'PE' => 'Peru',
        'FM' => 'Micronesia',
        'MM' => 'Myanmar',
        'MD' => 'Moldova',
        'MA' => 'Morocco',
        'MC' => 'Monaco',
        'MZ' => 'Mozambique',
        'MX' => 'Mexico',
        'NA' => 'Namibia',
        'ZA' => 'South Africa',
        'AQ' => 'Antarctica',
        'GS' => 'South Georgia and the South Sandwich Islands',
        'YU' => 'Yugoslavia',
        'NR' => 'Nauru',
        'NP' => 'Nepal',
        'NI' => 'Nicaragua',
        'NE' => 'Niger',
        'NG' => 'Nigeria',
        'NU' => 'Niue',
        'NO' => 'Norway',
        'NF' => 'Norfolk Island',
        'PW' => 'Palau',
        'PN' => 'Pitcairn',
        'PT' => 'Portugal',
        'MK' => 'Macedonia',
        'JP' => 'Japan',
        'SE' => 'Sweden',
        'CH' => 'Switzerland',
        'SV' => 'El Salvador',
        'WS' => 'Samoa',
        'SL' => 'Sierra Leone',
        'SN' => 'Senegal',
        'CY' => 'Cyprus',
        'SC' => 'Seychelles',
        'SA' => 'Saudi Arabia',
        'CX' => 'Christmas Island',
        'ST' => 'Sao Tome and Principe',
        'SH' => 'Saint Helena',
        'KN' => 'Saint Kitts and Nevis',
        'LC' => 'Saint Lucia',
        'SM' => 'San Marino',
        'PM' => 'Saint Pierre and Miquelon',
        'VC' => 'Saint Vincent and Grenadines',
        'LK' => 'Sri Lanka',
        'SK' => 'Slovakia',
        'SI' => 'Slovenia',
        'SJ' => 'Svalbard and Jan Mayen',
        'SZ' => 'Swaziland',
        'SD' => 'Sudan',
        'SR' => 'Suriname',
        'SB' => 'Solomon Islands',
        'SO' => 'Somalia',
        'TJ' => 'Tajikistan',
        'TW' => 'Taiwan',
        'TH' => 'Thailand',
        'TZ' => 'Tanzania',
        'TO' => 'Tonga',
        'TC' => 'Turks and Caicos Islands',
        'TT' => 'Trinidad and Tobago',
        'TN' => 'Tunisia',
        'TV' => 'Tuvalu',
        'TR' => 'Turkey',
        'TM' => 'Turkmenstan',
        'TK' => 'Tokelau',
        'WF' => 'Wallis and Futuna',
        'VU' => 'Vanuatu',
        'GT' => 'Guatemala',
        'VE' => 'Venezuela',
        'BN' => 'Brunei',
        'UG' => 'Uganda',
        'UA' => 'Ukraine',
        'UY' => 'Uruguay',
        'UZ' => 'Uzbekistan',
        'ES' => 'Spain',
        'EH' => 'Western Sahara',
        'GR' => 'Greece',
        'HK' => 'HongKong',
        'SG' => 'Singapore',
        'NC' => 'New Caledonia',
        'NZ' => 'New Zealand',
        'HU' => 'Hungary',
        'SY' => 'Syria',
        'JM' => 'Jamaica',
        'AM' => 'Armenia',
        'YE' => 'Yemen',
        'IQ' => 'Iraq',
        'IR' => 'Iran',
        'IL' => 'Israel',
        'IT' => 'Italy',
        'IN' => 'India',
        'ID' => 'Indonesia',
        'GB' => 'United Kingdom',
        'VG' => 'Virgin Islands British',
        'IO' => 'British Indian Ocean Territory',
        'JO' => 'Jordan',
        'VN' => 'Viet Nam',
        'ZM' => 'Zambia',
        'TD' => 'Chad',
        'GI' => 'Gibraltar',
        'CL' => 'Chile',
        'CF' => 'Central Africa Republic',
        'CN' => 'China'
    ];
}