<?php
    $characters_title = 'Characters';
    $register_title = 'Register';
    $about_title = 'About';
    $films_title = 'Films';
    $anime_title = 'Anime';

    $film1_1 = array(
        'id' => 1,
        'name' => 'Dragon Ball',
        'imgURL' => 'https://avatars.mds.yandex.net/get-entity_search/1783226/473077677/S168x252_2x',
        'link' => 'https://jut.su/dragonball/',
    );

    $film1_2 = array(
        'id' => 2,
        'name' => 'Naruto Shippuden',
        'imgURL' => 'https://avatars.mds.yandex.net/get-entity_search/2005770/472973380/S134x201_2x',
        'link' => 'https://jut.su/naruto/',
    );

    $film1_3 = array(
        'id' => 3,
        'name' => 'One Piece',
        'imgURL' => 'https://avatars.mds.yandex.net/get-entity_search/9721020/687297742/S88x132_2x',
        'link' => 'https://jut.su/onepiece/',
    );

    $film1_4 = array(
        'id' => 4,
        'name' => 'Blue Lock',
        'imgURL' => 'https://upload.wikimedia.org/wikipedia/en/thumb/3/3f/Blue_Lock_key_visual.png/250px-Blue_Lock_key_visual.png',
        'link' => 'https://jut.su/blue-lock/'
    );

    $film1_5 = array(
        'id' => 5,
        'name' => 'Attack On Titan',
        'imgURL' => 'https://avatars.mds.yandex.net/get-entity_search/7751256/687292254/SUx182_2x',
        'link' => 'https://jut.su/shingekii-no-kyojin/',
    );

    $film2_6 = array(
        'id' => 6,
        'name' => 'Dr. Stone',
        'imgURL' => 'https://upload.wikimedia.org/wikipedia/ru/thumb/2/29/Doctor_stone.jpg/250px-Doctor_stone.jpg',
        'link' => 'https://jut.su/dr-stone/',
    );

    $film2_7 = array(
        'id' => 7,
        'name' => 'Death Note',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=848cf7432043d908a6f3e47cbab88fa979acaa32-5156037-images-thumbs&n=13',
        'link' => 'https://jut.su/death-note/'
    );

    $film2_8 = array(
        'id' => 8,
        'name' => 'One Punch Man',
        'imgURL' => 'https://avatars.mds.yandex.net/get-entity_search/5505928/1151709216/S88x132_2x',
        'link' => 'https://jut.su/one-punch-man/'
    );

    $film2_9 = array(
        'id' => 9,
        'name' => 'Chainsaw Man',
        'imgURL' => 'https://avatars.mds.yandex.net/get-entity_search/1727623/1189000026/S88x132_2x',
        'link' => 'https://jut.su/chainsaw-man/'
    );

    $film2_10 = array(
        'id' => 10,
        'name' => 'Jujutsu Kaisen',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=966a81f803bf1665a07f678d520f7c1f588e9d6f-16312836-images-thumbs&n=13',
        'link' => 'https://jut.su/jujutsu-kaisen/'
    );

    $films1 = array($film1_1, $film1_2, $film1_3, $film1_4, $film1_5);
    $films2 = array($film2_6, $film2_7, $film2_8, $film2_9, $film2_10);

    $character_1 = array(
        'id' => 1,
        'name' => 'Goku',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=8d7ae21386ae7c1238dd8d51b859a3fc0ec428f3-11938745-images-thumbs&n=13',
        'link' => 'https://en.wikipedia.org/wiki/Goku',
        'text' => 'Goku (born Kakarot) is the main hero of Dragon Ball, created by Akira Toriyama. He is a Saiyan, an alien warrior race, but was raised on Earth. Goku is cheerful, pure-hearted, and obsessed with training and fighting strong opponents. He has superhuman strength, speed, and the ability to use ki energy for flight and powerful attacks like the Kamehameha. Over time, he has achieved many legendary transformations, including Super Saiyan and Ultra Instinct. Throughout his journey, Goku battles powerful enemies (Frieza, Cell, Majin Buu, and more) while protecting Earth and the universe. He is also known for his friendly rivalry with Vegeta.',
    );

    $character_2 = array(   
        'id' => 2,
        'name' => 'Naruto Uzumaki',
        'imgURL' => 'data:image/jpeg;base64,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',
        'link' => 'https://en.wikipedia.org/wiki/Naruto',
        'text' => 'Naruto Uzumaki is the main character of the anime and manga Naruto by Masashi Kishimoto. He is a ninja from the Hidden Leaf Village who dreams of becoming Hokage. As a child, he was shunned because the Nine-Tails Fox (Kurama) was sealed inside him, but he never gave up. Naruto is energetic, stubborn, and kind. He believes in protecting his friends and never quitting. His main abilities include the Shadow Clone Jutsu, Rasengan, and later, the power of Kurama. Over time, he becomes a hero, ends the Fourth Great Ninja War, marries Hinata Hyuga, and achieves his dream of becoming the Seventh Hokage.',
    );

    $character_3 = array(
        'id' => 3,
        'name' => 'Monkey D. Luffy',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=1dedf8deb47426f1c89f2235132dba592ffa4796-5263021-images-thumbs&n=13',
        'link' => 'https://en.wikipedia.org/wiki/Monkey_D._Luffy',
        'text' => 'Monkey D. Luffy is the main character of One Piece, created by Eiichiro Oda. He is a pirate with the dream of finding the legendary treasure One Piece and becoming the Pirate King. After eating the Gomu Gomu no Mi (a Devil Fruit), his body gained the properties of rubber, letting him stretch and fight in unique ways. Luffy is cheerful, fearless, and has a strong sense of freedom and justice. He deeply values his friends and crew, the Straw Hat Pirates, whom he leads as captain. Luffy constantly grows stronger through battles and adventures across the seas, eventually mastering powerful techniques like Gear Second, Gear Third, and Gear Fifth.'
    );

    $character_4 = array(
        'id' => 4,
        'name' => 'Eren Yeager',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=15a281234bb8600414fba1ebfd0101d754090165-8981283-images-thumbs&n=13',
        'link' => 'https://en.wikipedia.org/wiki/List_of_Blue_Lock_characters',
        'text' => 'Eren Yeager is the main protagonist of Attack on Titan (Shingeki no Kyojin), created by Hajime Isayama. He grows up inside humanity’s walled cities, which protect people from man-eating giants known as Titans. As a child, Eren witnesses the destruction of his home and the death of his mother during a Titan attack. This fuels his intense hatred for Titans and his vow to destroy them all. He later discovers that he himself can transform into a Titan, the Attack Titan, giving him immense power in battle. Eren is passionate, determined, and impulsive, often driven by his desire for freedom.',
    );

    $character_5 = array(
        'id' => 5,
        'name' => 'Denji',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=023e00917445548a032d39270024bbdd8db97cf8-5419265-images-thumbs&n=13',
        'link' => 'https://en.m.wikipedia.org/wiki/Denji_(Chainsaw_Man)',
        'text' => 'Denji is a teenage devil hunter who starts life in extreme poverty, burdened by his deceased fathers debt to the Yakuza. He works dangerous jobs with his pet devil Pochita just to survive. After being betrayed and killed, Pochita sacrifices himself to save Denji, merging with his heart and turning him into Chainsaw Man—a hybrid who can summon chainsaws from his body. Denjis personality is raw and unfiltered. He doesnt dream of glory or justice; he just wants a normal life: good food, a warm bed, and affection. This simplicity makes him both relatable and tragic. Hes emotionally stunted from years of neglect and abuse, and his desperate need love makes him vulnerable to manipulation—especially by Makima, a high-ranking devil hunter who exploits his feelings.',
    );

    $character_6 = array(
        'id' => 6,
        'name' => 'Saitama',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=4bd1e6c54930c29aec53f7e97de0ad8ab73330df-5905521-images-thumbs&n=13',
        'link' => 'https://en.wikipedia.org/wiki/Saitama_(One-Punch_Man)',
        'text' => 'Saitama, also known as One Punch Man, is the main protagonist of the series One Punch Man, created by ONE. He is an ordinary man who trained so hard that he lost his hair but gained unimaginable strength—capable of defeating any opponent with a single punch. Despite his overwhelming power, Saitama is bored and frustrated because no fight challenges him anymore. He seeks excitement and a worthy rival but finds only disappointment as battles end instantly. Saitama is humble, laid-back, and often comically uninterested in the chaos around him. He becomes a professional hero in the Hero Association, where he is ranked low at first due to his unremarkable appearance and lack of recognition, even though he’s secretly the strongest hero alive.',
    );

    $character_7 = array(
        'id' => 7,
        'name' => 'Light Yagami',
        'info' => 'Good',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=5d2d0cf57df2c1d0c602b56495edc9427d5de8e2-5298869-images-thumbs&n=13',
        'link' => 'https://en.wikipedia.org/wiki/Light_Yagami',
        'text' => 'Light Yagami is the main protagonist of Death Note, created by Tsugumi Ohba (writer) and Takeshi Obata (artist). He is a highly intelligent and ambitious high school student who discovers the Death Note, a supernatural notebook that allows its user to kill anyone by writing their name while picturing their face. Light initially uses the Death Note with the goal of ridding the world of criminals and creating a perfect society, where he rules as a god-like figure known as “Kira.” However, his sense of justice becomes corrupted by his ego and desire for power. He is calm, calculating, and manipulative, able to outsmart even the world’s greatest detectives, including his rival L. Light’s story is a psychological battle of wits, exploring morality, justice, and corruption.',
    );

    $character_8 = array(
        'id' => 8,
        'name' => 'Senku Ishigami',
        'imgURL' => 'https://i.ytimg.com/vi/gxYNO6QTnPo/maxresdefault.jpg?sqp=-oaymwEmCIAKENAF8quKqQMa8AEB-AH-CYAC0AWKAgwIABABGGUgYihJMA8=&rs=AOn4CLCGa9EQ1RF3YLAIwbi4yhZuZp4JfA',
        'link' => 'https://en.wikipedia.org/wiki/Senku_Ishigami',
        'text' => 'Senku Ishigami is the main protagonist of Dr. Stone, created by Riichiro Inagaki (writer) and Boichi (artist). He is a teenage scientific genius who wakes up thousands of years after humanity was mysteriously turned to stone. Unlike typical shōnen heroes who rely on strength, Senku uses his vast knowledge of science to rebuild civilization from scratch, aiming to advance society from the Stone Age back to modern technology. His dream is to create a world where science can benefit everyone. Senku is logical, confident, and witty, often saying his trademark line: “This is exhilarating!” when facing scientific challenges.',
    );

    $character_9 = array(
        'id' => 9,
        'name' => 'Yuuji Itadori',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=1fa5879685c4529ecf5aff39bf937bceac5752bc-10122172-images-thumbs&n=13',
        'link' => 'https://en.wikipedia.org/wiki/Yuji_Itadori',
        'text' => 'Yuuji Itadori is the emotionally grounded, physically explosive protagonist of Jujutsu Kaisen. His story is a collision of grief, sacrifice, and moral conviction wrapped in cursed energy and chaos. Here’s a clean, text-only breakdown of who he is: Yuuji Itadori is a high school student who becomes a Jujutsu Sorcerer after ingesting a Cursed Object—one of the fingers of Ryomen Sukuna, the most powerful Curse in history. This act makes him Sukuna’s vessel, a role that places him at the center of the sorcerer world’s most dangerous conflicts. Despite the immense power and threat he carries, Yuuji remains deeply empathetic and committed to saving others.',
    );

    $character_10 = array(
        'id' => 10,
        'name' => 'Isagi Yoichi',
        'imgURL' => 'https://avatars.mds.yandex.net/i?id=54048260a59ea765f1786acc30b3c6d6dfbf2be0-10455853-images-thumbs&n=13',
        'link' => 'https://en.wikipedia.org/wiki/Ichigo_Kurosaki',
        'text' => 'Isagi Yoichi is the main protagonist of Blue Lock, a sports manga and anime series created by Muneyuki Kaneshiro (writer) and Yusuke Nomura (artist). He is a high school soccer player chosen to join the Blue Lock Project, a radical training program designed to create the best striker for Japan’s national team. At first, Isagi seems ordinary compared to other prodigies, but he possesses sharp tactical awareness and the ability to “read the field.” His greatest strength is his adaptability—he quickly learns from stronger rivals and evolves during matches. Isagi is determined, analytical, and hungry to become the world’s best striker.',
    );

    $characters = array($character_1, $character_2, $character_3, $character_4, $character_5, $character_6, $character_7, $character_8, $character_9, $character_10);
?>