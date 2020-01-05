---
layout: default
title: Other
parent: Architecture and Design
has_children: false
nav_order: 4
---


## XSS Prevention

TODO: we did not really prevent this, did we? I suggest not talking about it :-)
{: .label .label-red }

```php
<?php echo TemplateView::noHTML($customer->getName()) ?>
```

## Search Engine
The early version of the search engine was only based on the [BM25](https://github.com/KonstantinosMetallinos/BM25-for-PHP/blob/master/Okapi-BM25.php) matching algorithm. Although we improved this PHP implementation of BM25 using the [Porter Stemmer](https://tartarus.org/martin/PorterStemmer/) and stop word removal, this solution was not satisfying because of two reasons. First, each search request was handled on the fly instead of using predefined search indexes. This resulted in poor performance. Second, minor typos in the search queries could not be managed since only hard matches were possible.
In a later version, we implemented [TNTSearch](https://github.com/teamtnt/tntsearch) which is a powerful full text search component as it indexes all the content and allows fuzzy search.

![fuzzy search](resources/searcheng_fuzzy.png)

The information to be searched is passed via a single SQL query. The created index can later be selectively manipulated in case of insertion or manipulation of articles.
```php
private function initIndex(){

    $tnt = new TNTSearch;

    $tnt->loadConfig($this->getTNTConfig());

    $indexer = $tnt->createIndex(self::$indexname);

    $sql = 'SELECT cont.fld_cont_id as id, REPEAT(CONCAT(cont.fld_cont_title, \' \'), 5) as title,  REPEAT(CONCAT(cont.fld_cont_subtitle, \' \'), 3) as subtitle, cate.fld_cate_key as category, keyw.keyw_name as keywords, cont.fld_cont_body as body
            FROM tbl_content cont
            LEFT JOIN (SELECT coke.fld_cont_id, string_agg(keyw.fld_keyw_name, \' ; \'  ORDER BY keyw.fld_keyw_name) as keyw_name
                       FROM tbl_keyword keyw INNER JOIN tbl_contentkeyword coke on keyw.fld_keyw_id = coke.fld_keyw_id
                       GROUP BY coke.fld_cont_id) keyw on keyw.fld_cont_id = cont.fld_cont_id
            LEFT JOIN tbl_category cate on cont.fld_cate_id = cate.fld_cate_id;'   ;

    $indexer->query($sql);
    $indexer->run();
}
```

Since TNTSearch does not provide any functionality to boost specific query fields, the more important field are repeated more often than less important ones. In the case of lightread, `title` has a weight of 5, `subtitle` 3, and the rest 1.

![fuzzy search](resources/searcheng_boost.png)

TODO: mention subset searches
{: .label .label-red }




## Email Verification

TODO
{: .label .label-red }



## Tokenization

TODO
{: .label .label-red }



## jQuery Polling

TODO
{: .label .label-red }
