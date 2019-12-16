---
layout: default
title: Requirements
nav_order: 10
---
# Requirements

## Actors
### 0 User
Someone who signed up on the platform and hence has an account.
### 1 Consumer
A user that consumes the content on the platform but did not publish any content so far. Hence, Consumers are not able to earn Satoshis. Once they start publishing content, they become a Publisher. Reader serves as a synonym for this type of user.
### 2 Publisher
A user that consumes and provides content in form of articles on the platform and hence is able to earn Satoshis. Consumer specific requirements are also applicable to Publisher. Author serves as a synonym for this type of user.
### 3 Operator
Administrators that are able to see insights about the platform's activities and Lightning node.
### 4 Lightning Network Participant
Other Lightning node administrators who are interested in opening channels with our platform's Lightning node.


![class diagram describing participants](resources/participants.png)

## Minimum Requirements
| O# |  Description | Participating Actor |  
| -- | -- | -- |
| M01 | The platform shall allow visitors to become an User by creating an account. | 0 |

|M02|The platform shall allow Users to set up their profile, including enter some descriptive text about themselves and upload a profile picture. |0|
|M02|The platform shall allow Publishers to publish written content by means of a markdown editor.|2|
|M03|Publishers should have the option to incorporate simple media such as images or links in their markdown articles.|2|
|M04|Publishers shall have the option to offer their content for free and just rely on donations (free content).|2|
|M05|Publishers shall be able to restrict the access to the full content until the consumer paid a predefined fee for it (paid content). The fee can be set by the publisher and will be represented in amount of Satoshis.|2|
|M06|Consumers shall be able to read free content.|1|
|M07|Consumers shall be able to read paid content after they paid the indicated fee via the Lightning Network.|1|
|M08|Independent of free or paid content, Consumers shall be able to donate Satoshis to the content's Publisher using the Lightning Network|1|
|M09|The platform shall allow Consumers to re-access paid content without paying again.|1|
|M10|Publishers shall be able to see their current balance of received payments on their personal profile page.|2|
|M11|Publishers shall be able to withdraw a specific amount to their own controlled Lightning wallet.|2|
|M12|Operators shall be able to manage user accounts.|3|
|M13|Operators shall be able to overview Lightning transactions.|3|


## Optional Requirements
|O#|  Description | Participating Actor |   
|-----------|-----------|-----------|
|O01|The platform shall show the information of the Lightning Node in order for other participants to open channels with. |4|
|O02|Publisher should have the ability to examine the views and revenue per content over time.|1|
|O03|Publisher shall be able to publish audio files or video clips.|1|
|O11|Visitors shall be able to access paid content once they paid the correspondent fee without being logged in or without having a login. In this case, purchases shall be stored in the visitor's cookies.|??|


## Requirements according to MoSCoW
### Must-haves
### Should-haves
### Could-haves
- Ability to sign up without using an e-mail address.
### Won't- and Would-haves
- Directly sending Satoshis to a Publisher. Every transaction has to refer to a specific content.
