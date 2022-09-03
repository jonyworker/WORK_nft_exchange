import {onBeforeUnmount, onMounted, ref} from 'vue'
import moment from 'moment'

export interface IDuringDate {
    months: number;
    days: number;
    hours: number;
    minutes: number;
    seconds: number;
}

export const initDuration: IDuringDate = {
    months: 0,
    days: 0,
    hours: 0,
    minutes: 0,
    seconds: 0,
}
/**
 * 倒计时
 * @param date
 */

export const useCountdown = (date: Date) => {
    const durationDate = ref<IDuringDate>(initDuration)
    const isEnd = ref<boolean>(false)
    const timer: any = ref<number>()
    const buildTimer = () => {
        return setInterval(() => {
            const now = new Date()
            if (moment(date).isBefore(now, 'seconds')) {
                isEnd.value = true;
                durationDate.value = initDuration;
                timer.value && clearInterval(timer.value)
                return
            }
            const endTime = moment(date).unix()
            const nowTime = moment(now).unix()
            const during = moment.duration(endTime - nowTime, 'seconds');
            durationDate.value = {
                months: during.months(),
                days: during.days(),
                hours: during.hours(),
                minutes: during.minutes(),
                seconds: during.seconds()
            }
        }, 1000)
    }
    onMounted(() => {
        timer.value = buildTimer()
    })

    onBeforeUnmount(() => {
        timer.value && clearInterval(timer.value)
    })
    return {durationDate, isEnd}
}
