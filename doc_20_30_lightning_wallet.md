---
layout: default
title: Mobile Wallets
parent: Lightning Network
has_children: false
nav_order: 3
---

# Wallets
{: .no_toc }

Bitcoin and the Lightning Network built on top of it gives each individual user the ability to control their funds without any third party or custodian. No trust is needed and no permission required to transact. To benefit from these properties the user needs to store the funds in a self controlled wallet. This is a software which manages the keys to unlock the funds. A wallet is needed to obtain ownership of the funds that are earned via the lightread platform.  


## Table of contents
{: .no_toc .text-delta }

1. TOC
{:toc}

---

## Custodial vs. non-custodial wallets
Although withdrawing funds to a self-owned mobile wallet means getting in control of funds, there are still differences how the various wallets are designed and therefore how much control the user has. Often for user experience reasons the wallets take over the task of channel management in a central manner so that the user still needs to trust the wallet provider to collaborate in case he or she wants to create a transaction. Those wallets are called custodial because the wallet provider has custody over the funds.

## Overview of popular wallets
This list is not complete and aims to give a brief overview of the popular lightning wallets currently available.

For new users who want to start using lightread and obtain control of their earnings we recommend **Wallet of Satoshi** or **Blue Wallet** for user experience reasons. Set up is easy and channel management is not required since they operate in a custodial way. Also they support the relatively new [LNURL functionality](https://tkone7.github.io/lightread/doc_20_20_lightning_integration.html#via-lnurl) which we implemented for withdrawal of funds.

### Wallet of Satoshi
- **Control:** custodial
- **Difficulty:** easy
- **Target audience:** beginner
- **LNURL support:** Yes
- [AppStore](https://itunes.apple.com/us/app/wallet-of-satoshi/id1438599608)
- [Google Play](https://play.google.com/store/apps/details?id=com.livingroomofsatoshi.wallet)

### Blue Wallet
- **Control:** custodial
- **Difficulty:** easy
- **Target audience:** beginner
- **LNURL support:** Yes
- [AppStore](https://itunes.apple.com/app/bluewallet-bitcoin-wallet/id1376878040)
- [Google Play](https://play.google.com/store/apps/details?id=io.bluewallet.bluewallet)

### Breez (Beta)
- **Control:** non custodial
- **Difficulty:** easy
- **Target audience:** beginner
- **LNURL support:** No
- [AppStore](https://testflight.apple.com/join/wPju2Du7)
- [Google Play](https://play.google.com/apps/testing/com.breez.client)

### Bitcoin Lightning Wallet
- **Control:** non custodial
- **Difficulty:** medium
- **Target audience:** advanced users
- **LNURL support:** No
- [Google Play](https://play.google.com/store/apps/details?id=com.lightning.walletapp)

### Eclair
- **Control:** non custodial
- **Difficulty:** medium
- **Target audience:** intermediate users
- **LNURL support:** No
- [Google Play](https://play.google.com/store/apps/details?id=fr.acinq.eclair.wallet.mainnet2)

### Zap
- **Control:** non custodial
- **Difficulty:** medium
- **Target audience:** advanced users
- **LNURL support:** No
- [AppStore](https://apps.apple.com/us/app/zap-bitcoin-lightning-wallet/id1406311960)
- [Google Play](https://play.google.com/store/apps/details?id=zapsolutions.zap)
