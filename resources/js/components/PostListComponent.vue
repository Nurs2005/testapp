<template>
    <div>
        <div class="actions d-flex gap-2 justify-content-between mb-3">
            <h3>Посты</h3>
            <button id="modal_open" type="button" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop" class="btn btn-primary">Добавить пост
            </button>
        </div>

        <div class="card mb-3">
            <div class="card-header">Фильтр</div>
           <div class="card-body">
               <label for="category">Выберите категорию</label>
               <select class="form-select mb-3" id="category" aria-label="Выберите категорию"
                       v-model="category_id" @change="fetchPosts">
                   <option selected value="">Все категорий</option>
                   <template v-for="category in categories">
                       <option :value="category.id">{{category.header}}</option>
                   </template>
               </select>
           </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
             aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Добавить пост</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control mb-3"
                               placeholder="Заголовок" v-model="post.header">
                        <select class="form-select mb-3" aria-label="Выберите категорию" v-model="post.category_id">
                            <template v-for="category in categories">
                                <option :value="category.id">{{category.header}}</option>
                            </template>
                        </select>
                        <textarea name="description" class="form-control mb-3"
                                  cols="30" rows="10"
                                  style="text-align: left"
                                  v-model="post.description"
                                  placeholder="Описание"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button @click="savePost()" class="btn btn-primary">Сохранить</button>
                        <button id="close" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <a style="text-decoration: none" v-for="post in posts">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <a :href="'/post/' + post.id"><h4>{{ post.header }}</h4></a>
                        <button @click="open_post(post)" type="submit" class="btn btn-primary"
                                v-if="post.created_by == user_id">Редактировать</button>
                    </div>
                    <div class="card-body">{{ post.description }}</div>
                </div>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            categories: [],
            category_id: '',
            post: {
                id:'',
                header:'',
                description:''
            }
        };
    },
    props: {
        user_id: ''
    },
    created() {
        this.fetchPosts();
        this.fetchCategories();
        this.post.created_by = this.user_id
    },
    methods: {
        open_post(post){
            this.post = post
            document.getElementById('modal_open').click()
        },
        fetchCategories() {
            fetch('/api/categories')
                .then(response => response.json())
                .then(data => {
                    this.categories = data.categories;
                })
                .catch(error => {
                    console.error('Ошибка при получении:', error);
                });
        },
        fetchPosts() {
            console.log(this.category_id)
            fetch('/api/posts/'+ this.category_id)
                .then(response => response.json())
                .then(data => {
                    this.posts = data.data;
                })
                .catch(error => {
                    console.error('Ошибка при получении списка постов:', error);
                });
        },
        savePost() {
            fetch('/api/post', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(this.post),
            })
                .then(response => {

                    if (!response.success) {
                        console.log(response)
                    }
                    return response.json();
                })
                .then(() => {
                    this.fetchPosts();
                    document.getElementById('close').click()

                })
                .catch(error => {
                    console.error('There was a problem saving the data:', error);
                });
            this.post.header = ""
            this.post.description = ""
            this.post.category_id = ""
        }
    }
};
</script>

<style>
</style>
