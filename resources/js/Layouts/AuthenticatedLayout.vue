<template>
    <div>
        <div :class="[
            'min-h-screen',
            isDarkTheme ? 'bg-gray-900' : 'bg-gray-50'
        ]">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <!-- Left Section: Logo & Navigation -->
                    <div class="flex items-center space-x-6">
                        <NavLink :href="route('dashboard')" 
                            :class="[
                                'flex items-center space-x-2',
                                isDarkTheme ? 'text-gray-200 hover:text-blue-400' : 'text-gray-700 hover:text-blue-600'
                            ]">
                            <BsGridFill :class="isDarkTheme ? 'text-gray-300' : 'text-gray-600'" size="18"/>
                            <span>Dashboard</span>
                        </NavLink>
                    </div>

                    <!-- Center Section: Title with modern icon -->
                    <div class="flex items-center space-x-3" :class="isDarkTheme ? 'text-gray-200' : 'text-gray-800'">
                        <div :class="isDarkTheme ? 'bg-gray-700' : 'bg-blue-50'" class="p-2 rounded-lg">
                            <BsFillTicketPerforatedFill :class="isDarkTheme ? 'text-blue-400' : 'text-blue-500'" />
                        </div>
                        <h2 class="text-xl font-semibold">{{this.$page.props?.app_settings?.app_name}}</h2>
                    </div>

                    <!-- Right Section: Actions & User -->
                    <div class="flex items-center space-x-5">
                        <!-- Chat -->
                        <button @click="openChat" class="relative group p-2">
                            <BsChatSquareTextFill :class="isDarkTheme ? 'text-gray-300' : 'text-gray-600'" size="20"/>
                            <span 
                                class="absolute -top-1 -right-1 bg-blue-500 text-white rounded-full px-2 py-0.5 text-xs">
                                {{ unreadMessages }}
                            </span>
                        </button>

                        <!-- Notifications -->
                        <button @click="notification" class="relative group p-2">
                            <BsBellFill :class="isDarkTheme ? 'text-gray-300' : 'text-gray-600'" size="20"/>
                            <span v-if="enabel_notif"
                                class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full px-2 py-0.5 text-xs">
                                {{ notif }}
                            </span>
                        </button>

                        <!-- User Dropdown -->
                        <Dropdown>
                            <template #trigger>
                                <div :class="[
                                    'flex items-center space-x-3 cursor-pointer p-2 rounded-lg',
                                    isDarkTheme ? 'text-gray-200' : 'text-gray-700'
                                ]">
                                    <div :class="isDarkTheme ? 'bg-gray-700' : 'bg-gray-100'" class="p-1.5 rounded-lg">
                                        <BsFillPersonFill :class="isDarkTheme ? 'text-gray-300' : 'text-gray-700'" size="20"/>
                                    </div>
                                    <span>{{ $page.props.auth.user.name }}</span>
                                    <BsChevronDown class="text-gray-500" size="14"/>
                                </div>
                            </template>
                            
                            <template #content>
                                <div :class="isDarkTheme ? 'bg-gray-800' : 'bg-white'" class="py-1">
                                    <DropdownLink :href="route('profile.edit')" class="flex items-center space-x-2 px-4 py-2 text-sm">
                                        <BsGearFill class="text-gray-500" size="14"/>
                                        <span>Profile</span>
                                    </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" class="flex items-center space-x-2 px-4 py-2 text-sm text-red-600">
                                        <BsBoxArrowRight class="text-red-600" size="14"/>
                                        <span>Log Out</span>
                                    </DropdownLink>
                                </div>
                            </template>
                        </Dropdown>
                    </div>
                </div>
            </div>

                <slot />
            
        </div>
    </div>
</template>

<script>


import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import { 
    BsKanbanFill,
    BsChatSquareTextFill,
    BsBellFill,
    BsFillPersonFill,
    BsGridFill,
    BsChevronDown,
    BsGearFill,
    BsBoxArrowRight,
    BsFillTicketPerforatedFill,
} from 'vue-icons-plus/bs';

export default {
    components: {
        BsKanbanFill,
        BsChatSquareTextFill,
        BsBellFill,
        BsFillPersonFill,
        BsGridFill,
        BsChevronDown,
        BsGearFill,
        BsBoxArrowRight,
        ApplicationLogo,
        Dropdown,
        DropdownLink,
        NavLink,
        BsFillTicketPerforatedFill,
        ResponsiveNavLink,
        Link,
    },
    computed: {
        isDarkTheme() {
            return this.$page.props?.app_settings?.color === 'black';
        }
    },
    data() {
        return {
            showingNavigationDropdown: false,
            notifications:  [],
            notif:  0,
            enabel_notif: this.$page.props?.app_settings?.notifications ,
            messages:  [],
            unreadMessages:0
        };
    },

    created() {

        this.$page.props?.notifications.forEach((e) => {
        if (e.title !== "chat") {
            console.log("------------lololo>>>>>>>>>>", e);
            this.notifications.push(e); 
            this.notif = this.notifications.length;// Push "New Message" items to notifications
        } else {
            this.messages.push(e);
            this.unreadMessages = this.messages.length; // Push other items to messages
        }
    });


        window.Echo.private(`notifications.${this.$page.props.auth.user.id}`)
        .listen("NotificationEvent", (e) => {
            console.log("------------lololo",e)
            if(e.title === "New Message")
            {
                this.notifications.push(e.message);
                this.notif = this.notifications.length;
            }
            else{
                this.messages.push(e.message);
                this.unreadMessages = this.messages.length;
            }

        });


    },
    methods: {
        toggleDropdown() {
            this.showingNavigationDropdown = !this.showingNavigationDropdown;
        },
        notification() {
            if(this.enabel_notif) {
                this.$inertia.visit(`/notifications`);
            }
        },
        openChat() {
            this.$inertia.visit('/alluserschat');
            this.unreadMessages = 0;
        }
    },
};
</script>
