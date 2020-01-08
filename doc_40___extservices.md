---
layout: default
title: External Services
has_children: false
nav_order: 40
---
# External services used
{: .no_toc }


## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

## Price data
The market price is periodically polled from [CoinMarketCap](https://coinmarketcap.com/api/documentation/v1/) via API. Each requested price is stored in our database with its time stamp. This allows to keep the API call frequency low since the next call is only execute if the previous one is older than a given tolerance in minutes (currently 5'). Is this not the case, the price in the database is used. The architecture allows to store any currency combination.

![fuzzy search](resources/external_price.png)


## ?'#!...

TODO: are there any further?
{: .label .label-red }
