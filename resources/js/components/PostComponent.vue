<template>
    <div>
      <h2>Посты</h2>
      <ul>

      </ul>
    </div>
  </template>

  <script>
  export default {
  data() {
    return {
      posts: [] // массив для хранения постов
    };
  },
  created() {
    this.fetchPosts(); // вызываем метод fetchPosts при создании компонента
  },
  methods: {
    fetchPosts() {
      fetch('/api/posts') // делаем запрос к серверу для получения списка постов
        .then(response => response.json())
        .then(data => {
          this.posts = data; // обновляем массив постов с данными с сервера
        })
        .catch(error => {
          console.error('Ошибка при получении списка постов:', error);
        });
    }
  }
};
  </script>
  
  <style>
  </style>
  