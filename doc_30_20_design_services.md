---
layout: default
title: Services
parent: Architecture and Design
has_children: false
nav_order: 2
---

# Services
{: .no_toc }

The business logic is incorporated in different services.

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---


![Services](resources/services.png)



TODO: Should the sections below be extended? Roman suggests not.
{: .label .label-red }

## AuthServiceImpl
Verifies user logins, issues and validates tokens.

## CategoryServiceImpl
Allows to request individual or all categories.

## ContentServiceImpl
Creates and updates content. Requests individual contents, sets of contents, or a content's turnover. Manages to only display a preview of paid content.

## EmailServiceClient
Creates and sends emails using [SendGrid](https://sendgrid.com/docs/).

## InvoiceServiceImpl
Communicates with connected Lightning node using [gRPC](https://grpc.io/) in order to create Lightning invoices (payments and withdrawals). Allows to request status of user payments and enables to payout Satoshis to users's own-controlled Lightning wallet.

## KeywordServiceImpl
Allows to request individual or all keywords (tags). Creates new keywords if inexistent. Associates tags with keywords.

## MarketDataServiceImpl
Polls recent price data from [CoinMarketCap](https://coinmarketcap.com/api/documentation/v1/) via API and stores them in database.

## SearchServiceImpl
Implementation of [TNTSearch](https://github.com/teamtnt/tntsearch) that matches search queries with documents (contents) using stop words removal, stemming, fuzzy search, and BM25 ranking.

## SpyServiceImpl
Sniffs IP address, operating system, device type, browser type of content viewers.

## UserServiceImpl
Creates and updates users. Requests individual users by id or name. Informs about a user's transaction history and turnover.

## ViewServiceImpl
Registers new content views aligned with meta data gathered through SpyServiceImpl.
