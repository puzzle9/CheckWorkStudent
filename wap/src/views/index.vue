<template>
  <van-loading class="loading" v-if="loading" vertical>加载中...</van-loading>
  <div v-else class="Index">
    <van-pull-refresh v-model="isRefresh" :head-height="70" @refresh="getData">
      <div class="date">
        <van-cell title="选择日期" :value="date" @click="dateShow = true" />
        <van-calendar v-model:show="dateShow" :min-date="new Date(2020, 8, 1)" :maxDate="new Date(2021, 2, 31)" @confirm="dateConfirm" :show-title="false" />
      </div>

      <div class="dorm">
        <van-tabs v-model:active="dorm_id" scrollspy sticky :offset-top="40">
          <van-tab v-for="dorm in dorms" :name="dorm.id">
            <template #title>{{ dorm.name }}</template>
            <van-cell-group class="group">
              <template #title>{{ dorm.name }} {{ datas[dorm.id].remark }}</template>
              <van-cell size="large" v-for="(student, student_id) in datas[dorm.id].students" :key="student_id">
                <template #title>
                  <span>{{ student.name }} {{ student.remark }}</span>
                  <a v-if="student.phone" class="phone" :href="`tel:${student.phone}`">{{ student.phone }}</a>
                </template>
                <template #label>
                  <span>{{ student.bed_name }} 号床</span>
                  <a v-if="student.parent_phone" class="phone" :href="`tel:${student.parent_phone}`">
                    {{ student.parent_phone }}
                    {{ student.parent_type }}
                  </a>
                </template>
                <template #right-icon>
                  <van-switch v-model="student.status" :loading="student.loading" size="24" @change="studentChangeStatus(student)" />
                </template>
              </van-cell>
              <van-collapse v-model="studentRemarkInput" accordion>
                <van-collapse-item title="备注" :name="dorm.id">
                  <van-field v-model="datas[dorm.id].body" :rows="4" autosize maxlength="300" type="textarea" placeholder="请输入备注" show-word-limit @blur="dormChangeBody(datas[dorm.id])" />
                </van-collapse-item>
              </van-collapse>
            </van-cell-group>
          </van-tab>
        </van-tabs>
      </div>
    </van-pull-refresh>

    <div class="shift">
      <van-tabbar v-model="shift_id" @change="shiftChange" placeholder>
        <van-tabbar-item v-for="info in shift" :key="info.id" icon="clock-o" :name="info.id">{{ info.name }}</van-tabbar-item>
      </van-tabbar>
    </div>
  </div>
</template>

<script>
  import dayjs from 'dayjs'
  import fly from '../utils/fly'
  const formatTime = (time) => dayjs(time).format('YYYY-MM-DD')

  export default {
    name: 'Index',
    data() {
      return {
        loading: true,
        isRefresh: true,
        date: formatTime(new Date()),
        dateShow: false,
        dorms: [],
        dorm_id: 1,
        shift: [],
        shift_id: 1,
        datas: {},
        studentRemarkInput: [],
      }
    },
    async mounted() {
      await fly.get('/dorms').then((res) => (this.dorms = res))
      await fly.get('/shift').then((res) => (this.shift = res))

      this.getData()
    },
    methods: {
      getData() {
        this.isRefresh = true
        fly
          .get('/lists', {
            date: this.date,
            shift_id: this.shift_id,
          })
          .then((res) => {
            this.datas = res
            this.loading = false
            this.isRefresh = false
            this.studentRemarkInput = []
          })
      },
      dateConfirm(date) {
        this.date = formatTime(date)
        this.dateShow = false
        this.getData()
      },

      shiftChange(shift_id) {
        this.getData()
      },

      studentChangeStatus(student) {
        student.loading = true

        fly
          .post('/sign', {
            date: this.date,
            shift_id: this.shift_id,
            dorm_id: student.dorm_id,
            student_id: student.student_id,
            status: student.status,
          })
          .then(() => {
            student.loading = false
          })
      },

      dormChangeBody(dorm) {
        fly.post('/remark', {
          date: this.date,
          shift_id: this.shift_id,
          dorm_id: dorm.dorm_id,
          body: dorm.body,
        })
      },
    },
  }
</script>

<style lang="stylus" scoped>
  .loading
    margin-top: 10px
    text-align: center

  .date
    position: fixed
    width: 100%
    z-index: 100

  .dorm
    padding-top: 30px

  .phone
    font-size: 12px
    padding-left: 10px
    color: rgb(150, 151, 153)
</style>
