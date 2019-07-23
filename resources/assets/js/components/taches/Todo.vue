<template>

    
    <section class="todoapp container">
        <header class="header">
            <h1>Gestion des Taches</h1>
            <input type="text" class="new-todo" v-model="newTodo" placeholder="Ajouter une tâche" @keyup.enter="addTodo">
        </header>
        <div class="main">
            <input type="checkbox" class="toggle" v-model="allDone">
            <ul class="todo-list">
                <li class="todo" v-for="todo in filteredTodos" :key="todo" :class="{completed: todo.completed, editing: todo === editing}">
                    <div class="view">
                        <input type="checkbox" v-model="todo.completed" class="toggle">
                        <label @dblclick="editTodo(todo)"> {{todo.nom}}</label>
                        <button class="destroy" @click.prevent="supTodo(todo)"></button>
                    </div>
                    <input type="text" class="edit" v-model="todo.nom" @keyup.enter="doneEdit" @blur="doneEdit" @keyup.esc="cancelEdit">
                </li>
            </ul>
        </div>

        <footer class="footer" v-show="todos.length > 0">
            <span class="todo-count">
               <strong>{{reste}}</strong> tâches à faire
            </span>
            <ul class="filters">
                <li><a href="#" :class="{selected: filter === 'all'}" @click.prevent="filter = 'all'">Toutes les tâches</a> </li>
                <li><a href="#" :class="{selected: filter === 'todo'}"  @click.prevent="filter = 'todo'">Tâches à faire</a> </li>
                 <li><a href="#" :class="{selected: filter === 'done'}"  @click.prevent="filter = 'done'">Tâches faites</a> </li>


            </ul>
            <button class="clear-completed" v-show="doneCompleted" @click.prevent="supToutes">Supprimer les tâches faites</button>
        </footer>
    </section>

</template>


<script>
export default {
    data(){
        return {
            todos: [],
            newTodo: '',
            filter: 'all',
            editing: null,
            oldTodo: ''
        }
    },

    computed: {
        reste () {
            return this.todos.filter(todo => !todo.completed).length
        },

        doneCompleted() { 
            return this.todos.filter(todo => todo.completed).length
            },

        allDone: {
            get () {
                return this.reste === 0

            },

            set(value) {
                
                    this.todos.forEach(todo => {
                        todo.completed = value
                    })
                
            }
        },
        
        filteredTodos (){
            if(this.filter === 'todo'){
                return this.todos.filter(todo => !todo.completed)
            }else if(this.filter === 'done'){
                 return this.todos.filter(todo => todo.completed)

            }else{
             return this.todos

            }
        }
    },

    methods:{
        addTodo (){
            this.todos.push({
                completed: false,
                nom: this.newTodo
            })
            this.newTodo = ''
        },

        supTodo(todo) {
            this.todos = this.todos.filter(i => i !== todo)
        },

        supToutes() {
            this.todos = this.todos.filter(todo => !todo.completed)
        },

        editTodo(todo) {
            this.editing = todo
            this.oldTodo = todo.nom 
        },

        doneEdit() {
            this.editing = null
        },

        cancelEdit() {
            this.editing.nom = this.oldTodo
            this.doneEdit()
        }
    }
    
}
</script>



