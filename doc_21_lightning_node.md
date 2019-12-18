---
layout: default
title: Full Node
parent: Lightning
has_children: false
nav_order: 1
---
# Running a Full Node
{: .no_toc }

There are various ways to participate in the Lightning Network. For our use case we decided to run our own **Bitcoin full node** and run the Lightning implementation **LND** on it.

It is called full node because it is a [fully validating Bitcoin node](https://bitcoin.org/en/full-node). This means it verifies transactions and blocks from other nodes in the network and stores them on its own internal storage. Therefore, it has a copy of the full blockchain since its launch in 2009.

It is important to note that in our case there is only one Lightning Node involved which is receiving all the payments. Therefore, authors receiving money for *reads* or *donations* do not control their funds immediately, only after withdraw their balance. `@todo link to withdraw balance use case`

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

## Hardware
Since running lightning uses very little resources, a single board computer like a Raspberry Pi is sufficient. Running it on a self-owned dedicated device is more secure than outsourcing it to any cloud service provider. The device contains sensitive private key information which is able to unlock cryptocurrency funds.

To setup the full node we followed the [extensive guide created by Stadicus](https://stadicus.github.io/RaspiBolt/). We used the following hardware parts:
- Raspiberry 3, 2 GB RAM
- Micro SD card (32 GB)
- 2 TB Harddrive (Western Digital)
- Raspberry Pi Case

![Raspberry Pi](resources/raspibolt.jpeg)

## Software
The following software is running on the Pi:

- **Operating System**: Raspbian
- **Bitcoin**: Bitcoin Core (bitcoind)
- **Lightning**: LND by lightninglabs

## Manage channels


## Connect node to web server
