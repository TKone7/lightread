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
The market price is periodically pulled from [CoinMarketCap](https://coinmarketcap.com/api/documentation/v1/) via API. Each requested price is stored in our database with its time stamp. This allows to keep the API call frequency low as only each 5 minutes another call is executed. Otherwise the price in the database is used.
