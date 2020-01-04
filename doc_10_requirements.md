---
layout: default
title: Requirements
nav_order: 10
---
# Requirements

## Actors
### 0 User
Someone who signed up on the platform and hence has an account. An User becomes a Publisher after successful verification by indicating a valid email address. Unverified Users are deemed as Consumers. Some special Users are deemed as Admins. Platform visitors who do not login are deemed as Visitors.
### 1 Consumer
A Consumer is an unverified User that only can consume content on the platform but is not allowed to publish any content so far. Consequently, Consumers are not able to earn Satoshis. Once they become verified, they become a Publisher and hence may start earning Satoshis. Synonym for Consumer is Reader.
### 2 Publisher
A Publisher is a verified user that can consume and publish content on the platform. Consequently, Publishers are able to earn Satoshis. Consumer specific requirements are also applicable to Publisher. Synonym for Publisher is Author.
### 3 Admins
An Admin is a verified User that is able to see insights about the platform's activities and the platform's Lightning nodes. They are also administrators of the platform's Lightning node.
### 4 Lightning Network Participant
Other Lightning node administrators who are interested in opening channels with our platform's Lightning node.


![class diagram describing participants](resources/participants.png)


## Requirements
The following lists show the requirement of this web project, grouped using the [MoSCoW method](https://en.wikipedia.org/wiki/MoSCoW_method). The check box indicates whether a requirement is fulfilled in the current implementation or not.
### Must-haves
- [x] Visitors must be able to become an User by creating an account.
- [] Users must be able to search for articles.
- [] Publishers must be able to write content using a markdown editor.
- [] Publishers must be able to associate an article with a category.
- [] Publishers must have the option to offer their content for free (free content).
- [] Publishers must be able to restrict the access to the full content until the consumer paid a predefined fee for it (paid content). The fee can be set by the publisher itself and will be represented in amount of Satoshis.
- [] Visitors and Users must be able to read free content.
- [] Visitors and Users must be able to read paid content after the corresponding fee is paid via the Lightning Network.
- [] Users must be able to re-access already paid content without paying again.
- [] Publishers must be able to withdraw a specific amount their generated revenue in Satoshis to their own-controlled Lightning wallet.
- [] Publishers must be able to see their current balance of received payments and donations as well as realized withdrawals on their personal profile page.

### Should-haves
- [] Publishers should be able to store articles as draft.
- [] Visitors and Users should have the option to tip on paid or free content by donating some Satoshis via the Lightning Network.
- [] Publishers should have the option to incorporate simple media such as images or links in their markdown articles.
- [] Publishers should be able to tag an article using up to 6 keywords.
- [] Publishers should see the transaction history of all payments and donations.
- [] Ability to sign up without using an e-mail address.
- [] Publishers should be forced to withdraw revenues once they excited a certain balance.

### Could-haves
- [] Visitors must be able to re-access already paid content without paying again, as long their browser cookies still exist.
- [] Visitors that decide to create an account and hence become an user could have their already paid content be transferred as long as their browser cookies still exist.
- [] Written content could be stored as draft which does not publish it.
- [] Publisher could be able to examine the views and revenue per content over time in form of charts.
- [] Allow Users to set up their profile, including enter some descriptive text about themselves and upload a profile picture.
- [] Admins could be able to manage user accounts via web interface.
- [] Admins could be able to monitor all Lightning transactions happening on the platform via web interface.
- [] The platform shall show the information of the connected Lightning node in order to allow other node administrators to open channels with it.

### Won't- and Would-haves
- [] The platform will not allow to directly sending Satoshis to a Publisher. Transactions are always realized on the basis of a specific content.
- [] Publisher will not be able to upload audio or video files.
