---
layout: default
title: Full Node
parent: Lightning Network
has_children: false
nav_order: 1
---
# Running a Full Node
{: .no_toc }

There are various ways to participate in the Lightning Network. For our use case we decided to run our own **Bitcoin full node** and run the Lightning implementation **LND** on it.

It is called full node because it is a [fully validating Bitcoin node](https://bitcoin.org/en/full-node). This means it verifies transactions and blocks from other nodes in the network and stores them on its own internal storage. Therefore, it has a copy of the full blockchain since its launch in 2009.

It is important to note that in our case there is only one Lightning Node involved which is receiving all the payments. Therefore, authors receiving money from customers **paying for content** or **donating** do not control their funds immediately. They first need to withdraw their balance outstanding balance. **Lightread's** service, therefore is fully **custodial** until the point when the user withdraws. This means that we have custody over user's funds.

## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

## Hardware
Since running lightning uses very little resources, a single board computer like a Raspberry Pi is sufficient. Running it on a self-owned dedicated device is more secure than outsourcing it to any cloud service provider. The device contains sensitive private key information which control other user's funds, which is why we wanted to be in full control of software and hardware.

To setup the full node we followed the <a href="https://stadicus.github.io/RaspiBolt/" target="blank">extensive guide created by Stadicus</a>. We used the following hardware parts:
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
In order to receive and send payments in the lightning network a node needs to be connected with other nodes by means of channels. Every channel connects two nodes and has a certain capacity of Bitcoins that are assigned to it (locked up on the base chain). This capacity is distributed between two channel parties and represents their balance. The balance sitting on our side of the channel is referred to as `local balance` and balance of the peer is called `remote balance`. The current channels we opened to other lightning peers are public and can be <a href="https://1ml.com/node/02f2db91d9c63aeeff2b2661b5398e4146aeb2cdb10fa48e570a2c20a420072672" target="blank">examined here</a>. Note that for privacy reasons only `channel capacity` and no balances are known to the public.

As administrators of our web application we want to see the current state of the connected lightning node and all its channels. We implemented a node overview which is only displayed to administrators. It can be seen here: <a href="https://lightread.ch/node" target="blank">https://lightread.ch/node</a> (only after logging in with administrator rights). Since this information is retrieved directly from our node, we see more information about local and remote channel balances and also offchain and onchain balances.

## SSH port tunneling to web server
The lightning node is running on a Raspberry Pi in one of our home networks. In order to be accessible from the web server, a **permanent SSH connection** is opened by the lightning node and a SSH port tunneling is set up. The following command uses `autossh` to establish a stable connection from the Raspberry Pi to the web server (on 51.255.211.144) and forwards the remote port `10009` to the local port `10009`.
```
autossh -C -M 0 -v -N -o ServerAliveInterval=60 -R 10009:localhost:10009 root@51.255.211.144
```
This connection allows us to connect from the web server to the Lightning Node as if it would run on localhost. The following connection can be found in the database table `tbl_node`.
![Node Connection](resources/node.png)
