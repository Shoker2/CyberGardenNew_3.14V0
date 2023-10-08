import telebot
from telebot import types
import requests

# dict
global user_data
user_data = {}

# bot
token = '6600094209:AAFnVIdEzMaudDkJ_HpNn5WwxdZTIaubryQ'
bot = telebot.TeleBot(token)

# url syte
url_data_base = "http://zaskamilma.temp.swtest.ru/"
url_syte = "http://zaskamilma.temp.swtest.ru/site/autoriz.php"

# data base
get_data = lambda id, password: requests.post(f'{url_data_base}getdata.php', data={'id': id, 'password': password})
# change_password = lambda id, password, new_password: requests.post(f'{const_url}updatepassword.php', data={'id': id, 'password': password, 'new_password': new_password})
@bot.message_handler(commands=['start'])
def start(message):
    user_data[message.from_user.id] = {}
    # кнопки
    markup = types.ReplyKeyboardMarkup(resize_keyboard=True)
    btn_1 = types.KeyboardButton("Сайт")
    btn_2 = types.KeyboardButton("Получить данные контроллера")
    btn_3 = types.KeyboardButton("Выход")
    markup.add(btn_1, btn_2, btn_3)
    bot.send_message(message.chat.id, text="Привет 👋, {0.first_name}! Я бот для определения погоды 🌤️\n"
                                           "Вот, что я умею:\n"
                                           "1) Получить данные контроллера\n"
                                           "2) Сайт\n"
                                           "3) Выход"
                                           "4) О разработчиках".format(message.from_user), reply_markup=markup)

@bot.message_handler(content_types=['text'])
def get_weather(message):
    if message.text == 'Получить данные контроллера':
        if get_user_data(message.from_user.id) != None:
            contr = get_data(get_user_data(message.from_user.id)['id'], get_user_data(message.from_user.id)['password'])
            bot.send_message(message.chat.id,f"Температура 🌡️: {contr.json()['Data']['temper']}°C\nВлажность 💦: {contr.json()['Data']['humidity']}%")
        else:
            ans_bot = bot.send_message(message.chat.id, f"Введите, пожалуста, id и пароль через пробел".format(message.from_user))
            bot.register_next_step_handler(ans_bot, save_login_password)

    if message.text == "Сайт":
        markup = types.InlineKeyboardMarkup()
        button1 = types.InlineKeyboardButton("3.14v0 weather", url=url_syte)
        markup.add(button1)
        bot.send_message(message.chat.id, "Привет, {0.first_name} Нажми на кнопку и перейди на сайт)".format(message.from_user), reply_markup=markup)

    if message.text == 'Выход':
        if (get_user_data(message.from_user.id) != None):
            del user_data[message.from_user.id]
        bot.send_message(message.chat.id, "Готово".format(message.from_user))

def get_user_data(uid):
    try:
        return user_data[uid]
    except KeyError:
        return None

def valid_id(id):
    try:
        int(id)
        return True
    except ValueError:
        return False

def save_login_password(message):
    login_pass = str(message.text).split(' ')
    if str.isnumeric(login_pass[0]) and valid_id(login_pass[0]):
        contr = get_data(login_pass[0], login_pass[1])
        if contr.text == "Incorrect password or id" or len(login_pass) != 2:
            bot.send_message(message.chat.id,"Неверный id или пароль ❗")
        else:
            bot.send_message(message.chat.id, f"Температура 🌡️: {contr.json()['Data']['temper']}°C\nВлажность 💦: {contr.json()['Data']['humidity']}%")
            user_data[message.from_user.id] = {"id": login_pass[0], "password": login_pass[1]}
    else:
        bot.send_message(message.chat.id, "Неверный id или пароль ❗")


bot.polling(none_stop=True)