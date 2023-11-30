Задание выполнно примерно за 9 часов   kovalev.v.u@gmail.com 

**Как поставить: (с докером не успел)**

- поправить .env
- composer i
- ./artisan migrate
- ./artisan db:seed
- npm i (node version >18)
- npm run dev

**по Задача №1 (Backend):**
- добавил пагинацию, сразу все элементы объемно
- правильность работы апи по возвращаемым кодам статуса запроса
- доступ к элементы по uuid, не по id

**по Задача №2 (Frontend): основной затык по времени, не каждый день пользуюсь (**
- использован element-plus.org
- пагинация не реализована еще


**по Задача №3 (SQL):**
- неплохо бы добавить ключ по birth_date
- сам запрос:  
  SELECT phone_numbers.phone FROM `users` INNER JOIN phone_numbers ON users.id = phone_numbers.user_id
  WHERE  (users.birth_date BETWEEN now() - interval 25 year AND now() - interval 18 year);

**Задача №4 (Оптимизация)**

- необходим выбирать сразу всех пользователей в одном запросе, 
  для примера 100 пользователей будет 100 коннектов, рациональнее будет примерно так:
- $users = "Select * FROM users WHERE id IN('$_GET['user_ids']')"
