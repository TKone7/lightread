# Requirements

## Actors
### 0 User
Someone who signed up on the platform and hence has an account.
### 2 Publisher (the ones that provide content)
A user that provides content of any kind on the platform. These could be, for instance, authors, artists, composers, or researchers.
### 3 Consumers (the ones that consume content)
Either a visitor with no account or an user, that consume the content on the platform.
### 4 Platform operators
Administrators that are able to see insights about the platform's activities.
### 5 Lightning Network Participant
Other Lightning node administrators who are interested in opening channels with our platform's Lightning node.


![class diagram describing participants](resources/participants.png)

## Minimum Requirements

|O#|  Description | Participating Actor |   
|---|---|---|
|M0|The platform shall allow visitors to become an user by creating an account.||
|M1|The platform shall allow users to set up their profile, including enter some descriptive text about themselves and upload a profile picture. |1|
|M2|The platform shall allow publishers to publish written content by means of a markdown editor.|1|
|M3|Publishers should have the option to incorporate simple media such as images or links in their markdown articles.|1|
|M4|Publishers shall have the option to offer their content for free and just rely on donations, or to restrict access to the content until the consumer payed a certain price for it.|1|
|M5|Visiting customers shall be able to read and download content on the platform and pay for premium content via the Lightning Network.|2|     
|M5|Visiting customers shall be able tip small amounts via the Lightning Network to any producer of content.|2|
|M7|Visitors shall have the option to browse and pay for content on private basis without authentication, but have the option to store their purchases over the duration of their browser session by creating an account.|2|
|M8|Content producers shall see their current balance of received payments in their login and withdraw a specific amount to their own controlled lightning wallet.|1|
|M9|Platform providers shall be offered a dashboard to manage user accounts and see transactional data.|3|

## Optional Requirements
|O#|  Description | Participating Actor |   
|---|---|---|
|O1|The platform shall show the information of the Lightning Node in order for other participants to open channels with. |4|
|O2|Content providers should have the ability to examine their revenue streams per content from a statistical aspect|1|
|O3|The platform shall allow a producer to publish media files (audios, videos, images).|1|

## Requirements according to MoSCoW
### Must-haves
### Should-haves
### Could-haves
### Won't- and Would-haves
