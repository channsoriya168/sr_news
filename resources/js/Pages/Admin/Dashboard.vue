<template>
    <head-app title="Admin Dashboard" />
    <!-- Statistics Cards -->
    <v-container fluid class="dashboard-content">
        <!-- Main Stats Row -->
        <v-row class="mb-6">
            <v-col
                cols="12"
                sm="6"
                md="3"
                v-for="(stat, index) in mainStats"
                :key="index"
            >
                <v-card
                    class="stat-card"
                    :class="`stat-card-${stat.color}`"
                    elevation="1"
                    hover
                >
                    <v-card-text class="pa-6">
                        <div class="d-flex align-center justify-space-between">
                            <div>
                                <p class="stat-label">{{ stat.label }}</p>
                                <h3 class="stat-value">{{ stat.value }}</h3>
                                
                            </div>
                            <div class="stat-icon">
                                <i :class="`mdi ${stat.icon}`"></i>
                            </div>
                        </div>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>

     
    </v-container>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { router } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import HeadApp from "../../components/Admin/HeadApp.vue";

// Current date
const currentDate = computed(() => {
    return new Date().toLocaleDateString("en-US", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
    });
});

// Main statistics
const mainStats = ref([
    {
        label: "អ្នកសរសេរព័ត៍មាន",
        value: "1,234",
        change: "+12",
        trend: "up",
        changeColor: "success",
        color: "primary",
        icon: "mdi-newspaper-variant",
    },
    {
        label: "អ្នកប្រើប្រាស់",
        value: "5,678",
        change: "+8",
        trend: "up",
        changeColor: "success",
        color: "secondary",
        icon: "mdi-account-group",
    },
    {
        label: "ប្រភេទនៃព័ត៍មាន",
        value: "24",
        change: "+2",
        trend: "up",
        changeColor: "success",
        color: "info",
        icon: "mdi-tag-multiple",
    },
    {
        label: "Comments",
        value: "890",
        change: "-3",
        trend: "down",
        changeColor: "error",
        color: "warning",
        icon: "mdi-comment-multiple",
    },
]);


</script>

<style scoped>
/* Dashboard Header */
.dashboard-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 0;
    margin-bottom: 2rem;
    border-radius: 0 0 20px 20px;
    color: white;
}

.dashboard-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.dashboard-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.date-widget {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.75rem 1.5rem;
    border-radius: 30px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    font-weight: 500;
}

.date-widget i {
    margin-right: 0.5rem;
}

/* Dashboard Content */
.dashboard-content {
    padding: 0 1rem;
}

/* Stat Cards */
.stat-card {
    border-radius: 16px;
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.08);
    background: white;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    border-radius: 16px 16px 0 0;
}

.stat-card-primary::before {
    background: linear-gradient(90deg, #667eea, #764ba2);
}

.stat-card-secondary::before {
    background: linear-gradient(90deg, #f093fb, #f5576c);
}

.stat-card-info::before {
    background: linear-gradient(90deg, #4facfe, #00f2fe);
}

.stat-card-warning::before {
    background: linear-gradient(90deg, #43e97b, #38f9d7);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.stat-label {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d3436;
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stat-change {
    font-size: 0.85rem;
    font-weight: 500;
    display: flex;
    align-items: center;
}

.stat-change i {
    margin-right: 0.25rem;
    font-size: 1rem;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(
        135deg,
        rgba(102, 126, 234, 0.1),
        rgba(118, 75, 162, 0.1)
    );
    color: #667eea;
}

.stat-icon i {
    font-size: 1.8rem;
}

/* Chart Card */
.chart-card,
.activity-card,
.quick-actions-card {
    border-radius: 16px;
    border: 1px solid rgba(0, 0, 0, 0.08);
    background: white;
}

.card-header {
    padding: 1.5rem 1.5rem 0;
    border-bottom: none;
}

.card-header h4 {
    font-weight: 600;
    color: #2d3436;
    margin: 0;
}

.chart-placeholder {
    height: 300px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e8f0ff 100%);
    border-radius: 12px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.chart-line {
    width: 80%;
    height: 2px;
    background: linear-gradient(90deg, #667eea, #764ba2);
    border-radius: 2px;
    margin-bottom: 1rem;
    position: relative;
}

.chart-line::before {
    content: "";
    position: absolute;
    width: 8px;
    height: 8px;
    background: #667eea;
    border-radius: 50%;
    top: -3px;
    left: 20%;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
}

.chart-info {
    text-align: center;
}

.chart-info p {
    color: #636e72;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

/* Activity Card */
.activity-list {
    max-height: 400px;
    overflow-y: auto;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f1f3f4;
    transition: background-color 0.2s ease;
}

.activity-item:hover {
    background-color: #f8f9fa;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
}

.activity-success {
    background-color: rgba(46, 204, 113, 0.1);
    color: #2ecc71;
}

.activity-info {
    background-color: rgba(52, 152, 219, 0.1);
    color: #3498db;
}

.activity-warning {
    background-color: rgba(241, 196, 15, 0.1);
    color: #f1c40f;
}

.activity-primary {
    background-color: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.activity-content {
    flex: 1;
}

.activity-text {
    font-weight: 500;
    color: #2d3436;
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.activity-time {
    color: #636e72;
    font-size: 0.8rem;
}

/* Quick Actions */
.quick-action-btn {
    height: 80px !important;
    border-radius: 12px !important;
    font-weight: 600 !important;
    text-transform: none !important;
    transition: all 0.3s ease !important;
}

.quick-action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.quick-action-btn i {
    font-size: 1.5rem;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .dashboard-header {
        padding: 1.5rem 0;
    }

    .dashboard-title {
        font-size: 2rem;
    }

    .stat-value {
        font-size: 2rem;
    }

    .date-widget {
        margin-top: 1rem;
        text-align: center;
    }
}

/* Scrollbar styling */
.activity-list::-webkit-scrollbar {
    width: 4px;
}

.activity-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 2px;
}

.activity-list::-webkit-scrollbar-thumb {
    background: #667eea;
    border-radius: 2px;
}

.activity-list::-webkit-scrollbar-thumb:hover {
    background: #764ba2;
}
</style>
