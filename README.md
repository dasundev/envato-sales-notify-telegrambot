# envato-sales-notify-telegrambot
This is specifically designed for Envato authors to be notified via telegram when a new sale is received.

# Installation
- Clone **envato-sales-notify-telegrambot** into your server root location.
- Install [Telegram App](https://telegram.org/) in your device.
- Search ```@BotFather``` & click on ```/start```
- Then type ```/newbot``` & type a name for your bot then press enter.
- Copy paste your ```$telegramApiKey``` with your Telegrame Api Token.
- Paste the following link in your browser. Replace <API-access-token> with the API access token that you identified or created in the previous section:
  ```https://api.telegram.org/bot<API-access-token>/getUpdates?offset=0```
- Send a message to your bot in the Telegram application. The message text can be anything. Your chat history must include at least one message to get your chat ID.
- Refresh your browser.
- Identify the numerical chat ID by finding the id inside the chat JSON object. In the example below, the chat ID is ```123456789```

  ```
  {  
   "ok":true,
     "result":[  
        {  
           "update_id":XXXXXXXXX,
           "message":{  
              "message_id":2,
              "from":{  
                 "id":123456789,
                 "first_name":"Mushroom",
                 "last_name":"Kap"
              },
              "chat":{  
                 "id":123456789,
                 "first_name":"Mushroom",
                 "last_name":"Kap",
                 "type":"private"
              },
              "date":1487183963,
              "text":"hi"
           }
        }
     ]
  }
  ```

- Update ```$chatID``` with your Chat ID.
- Create Envato API by this [link](https://build.envato.com/create-token/) with permission **View the user's items' sales history**
- Update ```$envatoApiKey``` with your Envato Token
- Add cronjob like this ```* * * * * cd /root/path/envato-sales-notify-telegrambot/ && php index.php```
- Enjoy :)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
This package is licensed under the [MIT](https://choosealicense.com/licenses/mit/) License.

## Buy Me A Coffee! :coffee:
If you can contribute with a donation or you want to, feel free to do it at [Buy me a coffee!](https://www.buymeacoffee.com/dasundev)☕, I will be really thankfull for anything even if it is a coffee or just a kind comment towards my work, because that helps me a lot. Whenever you contribute with a donation, I will read your message and it will be shown in my main site.
