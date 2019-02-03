<?php
//php parseurl.php *link to be parsed*

$url = $argv[1];
$parse = parse_url($url);
$stTld = [];
$parse['sld'] = sndLd($url, $stTld);
$parse['tld'] = thdLd($stTld);
$parse['extension'] = getExtension($url);
$parse['subdomain'] = getSubDomain($url, $parse);
$parse['domain'] = getDomain($url, $parse);
var_export($parse);

function sndLd($url, &$stTld)
{
    $tld = [".aero",".biz",".cat",".com",".coop",".edu",".gov",".info",".int",".jobs",".mil",".mobi",".museum",".name",".net",".org",".travel",
    ".ac",".ad",".ae",".af",".ag",".ai",".al",".am",".an",".ao",".aq",".ar",".as",".at",".au",".aw",".az",".ba",".bb",".bd",".be",".bf",".bg",
    ".bh",".bi",".bj",".bm",".bn",".bo",".br",".bs",".bt",".bv",".bw",".by",".bz",".ca",".cc",".cd",".cf",".cg",".ch",".ci",".ck",".cl",".cm",
    ".cn",".cr",".cs",".cu",".cv",".cx",".cy",".cz",".de",".dj",".dk",".dm",".do",".dz",".ec",".ee",".eg",".eh",".er",".es",".et",".eu",".fi",
    ".fj",".fk",".fm",".fo",".fr",".ga",".gb",".gd",".ge",".gf",".gg",".gh",".gi",".gl",".gm",".gn",".gp",".gq",".gr",".gs",".gt",".gu",".gw",
    ".gy",".hk",".hm",".hn",".hr",".ht",".hu",".id",".ie",".il",".im",".in",".io",".iq",".ir",".is",".it",".je",".jm",".jo",".jp",".ke",".kg",
    ".kh",".ki",".km",".kn",".kp",".kr",".kw",".ky",".kz",".la",".lb",".lc",".li",".lk",".lr",".ls",".lt",".lu",".lv",".ly",".ma",".mc",".md",
    ".mg",".mh",".mk",".ml",".mm",".mn",".mo",".mp",".mq",".mr",".ms",".mt",".mu",".mv",".mw",".mx",".my",".mz",".na",".nc",".ne",".nf",".ng",
    ".ni",".nl",".no",".np",".nr",".nu",".nz",".om",".pa",".pe",".pf",".pg",".ph",".pk",".pl",".pm",".pn",".pr",".ps",".pt",".pw",".py",".qa",
    ".re",".ro",".ru",".rw",".sa",".sb",".sc",".sd",".se",".sg",".sh",".si",".sj",".sk",".sl",".sm",".sn",".so",".sr",".st",".su",".sv",".sy",
    ".sz",".tc",".td",".tf",".tg",".th",".tj",".tk",".tm",".tn",".to",".tp",".tr",".tt",".tv",".tw",".tz",".ua",".ug",".uk",".um",".us",".uy",
    ".uz", ".va",".vc",".ve",".vg",".vi",".vn",".vu",".wf",".ws",".ye",".yt",".yu",".za",".zm",".zr",".zw"];
    foreach($tld as $tldValue)
    { 
        if (stristr(parse_url($url, PHP_URL_HOST), $tldValue))
        {
        $stTld[] = $tldValue;
        }
    }
    if(count($stTld)>1)
    {
        $sld = "$stTld[0]"."$stTld[1]";
        return $sld;
    }
}

function thdLd($stTld)
{
    $tld = end($stTld);
    return $tld;      
}

function getExtension($url)
{
    $fileExtensions = ['png', 'gif', 'jpg', 'jpeg', 'mp3', 'pdf', 'doc', 'mov', 'zip'];
    $extension = explode('.', parse_url($url, PHP_URL_PATH));
    foreach($fileExtensions as $value)
    {
        if(stristr(parse_url($url, PHP_URL_PATH), $value))
	    {
        $extension = $value;
        return $extension;
        }   
    }
}
       
function getSubDomain($url, $parse)
{
    $a = parse_url($url, PHP_URL_HOST);
    if($parse['sld'])
    {
        $a = str_replace(substr($a, strlen($a)-strlen($parse['sld'])), '', $a);
    }
    else
    {
       $a = str_replace(substr($a, strlen($a)-strlen($parse['tld'])), '', $a); 
    }
    $hoste = explode('.', $a);
    if(count($hoste) > 1)
    {
       array_pop($hoste);
       array_pop($hoste);
       $subDomain = implode('.',$hoste);
       return $subDomain;
    }
}   
       
function getDomain($url, $parse)
{
    $a = parse_url($url, PHP_URL_HOST);
    if($parse['subdomain'])
    {
        $a = str_replace($parse['subdomain'], '', $a);
    }
    return $a;
}
