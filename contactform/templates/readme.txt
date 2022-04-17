--- SQL ---

<< Tokens Table >>

CREATE TABLE `tokens` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `provider` varchar(255) NOT NULL,
 `provider_value` text NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--- Google Developers Console ---

Go to the Google Developer Console.
Create a new project. You can also select an existing project.
Add a name to your project. Google Console will generate a unique Project ID for it.
Your project will appear on top of the left sidebar.
Click on Library. You will see a list of Google APIs.
Enable Gmail API.
Click on the Credentials. Select Oauth Client id under Create credentials. Choose the radio button for Web Application.
Give the Name. Under Authorized JavaScript origins enter your domain URL. In the ‘Authorized redirect URIs’ add the link of the redirect URL. In my case, I passed the URL http://localhost/artisansweb/get_oauth_token.php
Click on the Create button. You will get a client ID and client secret in the pop-up. Copy these details. We will need it in a moment.