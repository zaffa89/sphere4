export function dateFormat(date)
{
    return dayjs(date).format('DD/MM/YYYY');
}

export function dateAndTimeFormat(date)
{
    return dayjs(date).tz('Europe/Rome').format('DD/MM/YYYY HH:mm:ss');
}

export function getAgeFromDate(dataNascita)
{
    return dayjs().diff(dayjs(dataNascita) , 'year');
}

export function timeFormat(date)
{
    return dayjs(date).format('HH:mm');
}