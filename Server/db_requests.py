import requests

const_url = "http://zaskamilma.temp.swtest.ru/"

get_data = lambda id, password: requests.post(f'{const_url}getdata.php', data={'id': id, 'password': password})
add_controller = lambda password: requests.post(f'{const_url}addcontroller.php', data={'password': password})
send_data = lambda id, password, data: requests.post(f'{const_url}updatedata.php', data={'id': id, 'password': password, 'data': data})
change_password = lambda id, password, new_password: requests.post(f'{const_url}updatepassword.php', data={'id': id, 'password': password, 'new_password': new_password})

if __name__ == "__main__":
    # r = add_controller("qwert")
    # print(r.text)
    id = '12'
    password = 'qwerty'

    r = get_data(id, password)
    print(r.text)

    # r = send_data(id, password, '{ "temper": 1.7, "humidity": 2.8 }')
    # print(r.text)

    # r = get_data(id, password)
    # print(r.json())

    # r = change_password(id, password, "qwerty")
    # print(r.text)
    # password = "sxfcgj"

    # r = get_data(id, password)
    # print(r.json())