-- Adminer 4.7.4 PostgreSQL dump (SAMPLE DATA)



INSERT INTO "tbl_user" ("fld_role_id", "fld_user_email", "fld_user_pwhash", "fld_user_creationpit", "fld_user_verified", "fld_user_firstname", "fld_user_lastname", "fld_user_nickname", "fld_user_picture", "fld_user_description", "fld_user_locked", "fld_user_deletionpit", "fld_user_isadmin") VALUES
((SELECT fld_role_id FROM tbl_role where fld_role_name='admin'),	'eucbrwef@wkoiu.com',	'$2y$10$M355suZPfy3hKc8HGfDzyejYBveNTZ7GgC.SFmyglO5Y0EPYhkZb6',	'2019-11-24 15:20:11',	't',	'Roman',	'Bögli',	'romusch',	NULL,	NULL,	'f',	NULL,	NULL),
((SELECT fld_role_id FROM tbl_role where fld_role_name='admin'),	'wdcoqxmx@zjubm.com',	'$2y$10$ocee0rWa6Tm/E32KIf2yquAQ3SxK.M4K9XS3CUJFO.oV7rjsnaFSy',	'2019-11-24 15:38:43',	't',	NULL,	NULL,	'toby',	NULL,	NULL,	'f',	NULL,	NULL),
((SELECT fld_role_id FROM tbl_role where fld_role_name='user'),	'mail@21isenough.me', '$2y$10$TC2YWy/4abt8me/pPl.HOusRxwmSK0TitE0k6XeZeT8wj5zjxv456', '2019-11-20 22:58:37.000000', 't', null, null, '21isenough', null, null, 'f',	NULL,	NULL);


INSERT INTO "tbl_content" ("fld_user_id", "fld_cate_id", "fld_accc_id", "fld_scon_id", "fld_cont_title", "fld_cont_subtitle", "fld_cont_body", "fld_cont_creationpit", "fld_cont_satoshis", "fld_cont_slug") VALUES
((select fld_user_id from tbl_user where fld_user_nickname='romusch'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Lifestyle'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='FREE'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'Sample Title',	'Sample Subtitle',
'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet *commodo magna eros quis urna.*
Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi **tristique** senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi **tristique** senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy. Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi **tristique** senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.

',	'2019-11-24 15:21:17',	0, 'acvd'),


((select fld_user_id from tbl_user where fld_user_nickname='romusch'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Food'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='PAID'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'This is me',	'A brief summary',	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
Fusce aliquet pede non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla.
Donec blandit feugiat ligula. Donec hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl eget sapien. Donec ut est in lectus consequat consequat.
Etiam eget dui. Aliquam erat volutpat. Sed at lorem in nunc porta tristique.

### **Proin nec augue.**
Quisque aliquam tempor magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
Nunc ac magna. Maecenas odio dolor, vulputate vel, auctor ac, accumsan id, felis. Pellentesque cursus sagittis felis.
Pellentesque porttitor, velit lacinia egestas auctor, diam eros tempus arcu, nec vulputate augue magna vel risus. Cras non magna vel ante adipiscing rhoncus. Vivamus a mi.
Morbi neque. Aliquam erat volutpat. Integer ultrices lobortis eros.
Donec elit est, consectetuer eget, consequat quis, tempus quis, wisi. In in nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.
Donec ullamcorper fringilla eros. Fusce in sapien eu purus dapibus commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
Cras faucibus condimentum odio. Sed ac ligula. Aliquam at eros.
Etiam at ligula et tellus ullamcorper ultrices. In fermentum, lorem non cursus porttitor, diam urna accumsan lacus, sed interdum wisi nibh nec nisl. Ut tincidunt volutpat urna.
Mauris eleifend nulla eget mauris. Sed cursus quam id felis. Curabitur posuere quam vel nibh.
Cras dapibus dapibus nisl. Vestibulum quis dolor a felis congue vehicula. Maecenas pede purus, tristique ac, tempus eget, egestas quis, mauris.',	'2019-11-24 15:20:45',	15, 'zrtz'),

((select fld_user_id from tbl_user where fld_user_nickname='romusch'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Love'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='FREE'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'A great Miracle',	'A brief summary of a wonder',	'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas porttitor congue massa. Fusce posuere, magna sed pulvinar ultricies, purus lectus malesuada libero, sit amet commodo magna eros quis urna.
Nunc viverra imperdiet enim. Fusce est. Vivamus a tellus.
Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin pharetra nonummy pede. Mauris et orci.
Aenean nec lorem. In porttitor. Donec laoreet nonummy augue.
Suspendisse dui purus, scelerisque at, vulputate vitae, pretium mattis, nunc. Mauris eget neque at sem venenatis eleifend. Ut nonummy.
Fusce aliquet pede non pede. Suspendisse dapibus lorem pellentesque magna. Integer nulla.
Donec blandit feugiat ligula. Donec hendrerit, felis et imperdiet euismod, purus ipsum pretium metus, in lacinia nulla nisl eget sapien. Donec ut est in lectus consequat consequat.
Etiam eget dui. Aliquam erat volutpat. Sed at lorem in nunc porta tristique.

### **Proin nec augue.**
Quisque aliquam tempor magna. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
Nunc ac magna. Maecenas odio dolor, vulputate vel, auctor ac, accumsan id, felis. Pellentesque cursus sagittis felis.
Pellentesque porttitor, velit lacinia egestas auctor, diam eros tempus arcu, nec vulputate augue magna vel risus. Cras non magna vel ante adipiscing rhoncus. Vivamus a mi.
Morbi neque. Aliquam erat volutpat. Integer ultrices lobortis eros.
Donec elit est, consectetuer eget, consequat quis, tempus quis, wisi. In in nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos.
Donec ullamcorper fringilla eros. Fusce in sapien eu purus dapibus commodo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
Cras faucibus condimentum odio. Sed ac ligula. Aliquam at eros.
Etiam at ligula et tellus ullamcorper ultrices. In fermentum, lorem non cursus porttitor, diam urna accumsan lacus, sed interdum wisi nibh nec nisl. Ut tincidunt volutpat urna.
Mauris eleifend nulla eget mauris. Sed cursus quam id felis. Curabitur posuere quam vel nibh.
Cras dapibus dapibus nisl. Vestibulum quis dolor a felis congue vehicula. Maecenas pede purus, tristique ac, tempus eget, egestas quis, mauris.',	'2019-11-24 15:20:45',	15, 'zrtz'),

((select fld_user_id from tbl_user where fld_user_nickname='romusch'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Travel'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='FREE'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'Summer in California',	'How the cool people spend their summer holiday',	'Sed ks',	'2019-11-24 15:33:49',	0, 'lol'),

((select fld_user_id from tbl_user where fld_user_nickname='romusch'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Travel'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='PAID'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'Translation Planet',	'Some thought by H. Rackham',	'### **Intro**
On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains. On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue
### **Solution**
And equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains. On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.',	'2019-11-24 15:35:14',	699, 'bcbb'),


((select fld_user_id from tbl_user where fld_user_nickname='toby'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Food'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='FREE'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'Random Text Generator',	'',	'Great [tool](https://www.randomtextgenerator.com/) to generate some sample articles
',	'2019-11-24 15:43:13',	0, 'hppo'),

((select fld_user_id from tbl_user where fld_user_nickname='toby'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Technology'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='PAID'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'Limits Expect Wonder',	'Now has you views woman noisy match money rooms?',	'An so vulgar to on points wanted. Not rapturous resolving continued household northward gay. He it otherwise supported instantly. Unfeeling agreeable suffering it on smallness newspaper be. So come must time no as. Do on unpleasing possession as of unreserved. Yet joy exquisit put sometimes enjoyment perpetual now. Behind lovers eat having length horses vanity say had its.

Much did had call new drew that kept. Limits expect law she. Now has you views woman noisy match money rooms. To up remark it eldest length oh passed. Off because yet mistake feeling has men. Consulted disposing to moonlight ye extremity. Engage piqued in on coming.

Mr do raising article general norland my hastily. Its companions say uncommonly pianoforte favourable. Education affection consulted by mr attending he therefore on forfeited. High way more far feet kind evil play led. Sometimes furnished collected add for resources attention. Norland an by minuter enquire it general on towards forming. Adapted mrs totally company two yet conduct men.

Necessary ye contented newspaper zealously breakfast he prevailed. Melancholy middletons yet understood decisively boy law she. Answer him easily are its barton little. Oh no though mother be things simple itself. Dashwood horrible he strictly on as. Home fine in so am good body this hope.

Open know age use whom him than lady was. On lasted uneasy exeter my itself effect spirit. At design he vanity at cousin longer looked ye. Design praise me father an favour. As greatly replied it windows of an minuter behaved passage. Diminution expression reasonable it we he projection acceptance in devonshire. Perpetual it described at he applauded.

Behaviour we improving at something to. Evil true high lady roof men had open. To projection considered it precaution an melancholy or. Wound young you thing worse along being ham. Dissimilar of favourable solicitude if sympathize middletons at. Forfeited up if disposing perfectly in an eagerness perceived necessary. Belonging sir curiosity discovery extremity yet forfeited prevailed own off. Travelling by introduced of mr terminated. Knew as miss my high hope quit. In curiosity shameless dependent knowledge up.

Consider now provided laughter boy landlord dashwood. Often voice and the spoke. No shewing fertile village equally prepare up females as an. That do an case an what plan hour of paid. Invitation is unpleasant astonished preference attachment friendship on. Did sentiments increasing particular nay. Mr he recurred received prospect in. Wishing cheered parlors adapted am at amongst matters.

Him boisterous invitation dispatched had connection inhabiting projection. By mutual an mr danger garret edward an. Diverted as strictly exertion addition no disposal by stanhill. This call wife do so sigh no gate felt. You and abode spite order get. Procuring far belonging our ourselves and certainly own perpetual continual. It elsewhere of sometimes or my certainty. Lain no as five or at high. Everything travelling set how law literature.

Are sentiments apartments decisively the especially alteration. Thrown shy denote ten ladies though ask saw. Or by to he going think order event music. Incommode so intention defective at convinced. Led income months itself and houses you. After nor you leave might share court balls.

In on announcing if of comparison pianoforte projection. Maids hoped gay yet bed asked blind dried point. On abroad danger likely regret twenty edward do. Too horrible consider followed may differed age. An rest if more five mr of. Age just her rank met down way. Attended required so in cheerful an. Domestic replying she resolved him for did. Rather in lasted no within no.

',	'2019-11-24 15:44:17',	999, 'aaaaaaaaaaaaajj'),
((select fld_user_id from tbl_user where fld_user_nickname='toby'),	(SELECT fld_cate_id FROM tbl_category where fld_cate_name='Love'),	(select fld_accc_id from tbl_accesscontraint where fld_accc_key='PAID'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'),	'MacBook Pro Review',	'Apple’s productivity machine gets the latest Intel tech',	'If you’re expecting a massive redesign in the MacBook Pro (15-inch, 2019), think again. This 2019 model, which hit the streets in the summer of 2019, feels like an iteration of last year’s model.

On the plus side, after spending some time putting it through the paces, we’ve come to realize that the MacBook Pro (15-inch, 2019) is also sporting some fresh features you won’t find in the older models  – and many of which have been long overdue. That keyboard, for one, gets an improved design, so it’s no longer problematic – a great news to long-suffering MacBook Pro users who need to upgrade their MacBook Pro anyway. Specs-wise, the highest configuration of the line now boasts some incremental changes, more than enough to make it worth the upgrade if you’ve got a 2017 or older MacBook.

With Windows laptop manufacturers putting up a solid effort to get Apple die-hards to switch, especially in the Ultrabook category where there are so many incredible Windows laptops, Apple needed to up the ante. And, with the new MacBook Pro (15-inch, 2019), it’s certainly back in the game. In fact, this laptop might just be fantastic enough to lure Windows users over to macOS. The MacBook Pro 15-inch (2019) is available in two main configurations (which you can further customize to better suit your needs and budget). First, there’s an option with a 2.6GHz 6-core 9th generation Intel Core i7 processor, Radeon Pro 555X with 4GB of GDDR5 memory, 16GB 2400MHz DDR4 RAM and 256GB SSD storage for $2,399 (£2,399, AU$3,499/AED9,999).

Source: techradar.com',	'2019-11-24 15:40:01',	12000, 'macbook'),


((select fld_user_id from tbl_user where fld_user_nickname='21isenough'), (SELECT fld_cate_id FROM tbl_category where fld_cate_name='Finance'),(select fld_accc_id from tbl_accesscontraint where fld_accc_key='PAID'),	(select fld_scon_id from tbl_statuscontent where fld_scon_key='PUBLISHED'), 'Appointment in Samarra', 'There is no subtitle', 'A merchant in Baghdad sends his servant to the marketplace for provisions. Soon afterwards, the servant comes home white and trembling and tells him that in the marketplace, he was jostled by a woman, whom he recognized as Death, who made a threatening gesture.

Borrowing the merchant’s horse, he flees at great speed to Samarra, a distance of about 75 miles, where he believes Death will not find him. The merchant then goes to the marketplace and finds Death, and asks why she made the threatening gesture to his servant.

She replies, “That was not a threatening gesture, it was only a start of surprise. I was astonished to see him in Baghdad, for I have an appointment with him tonight in Samarra.”', '2019-11-20 23:04:30.000000', 93, '0o0o0o');



-- 2019-11-24 15:53:53.615653+01
