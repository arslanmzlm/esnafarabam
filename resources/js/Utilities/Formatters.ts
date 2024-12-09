export function enginePowerFormat(enginePower: number | string): string {
    return `${enginePower} hp`;
}

export function engineSizeFormat(engineSize: number | string): string {
    return `${engineSize} cc`;
}

export function kilometerFormat(kilometer: number | string): string {
    return kilometer.toLocaleString('tr-TR', {
        style: 'unit',
        unit: 'kilometer',
        unitDisplay: 'short',
    });
}

export function currencyFormat(price: number | string): string {
    return price.toLocaleString('tr-TR', {
        style: 'currency',
        currency: 'TRY',
        unitDisplay: 'short',
        maximumFractionDigits: 0,
    });
}

export function dateFormat(date: string): string {
    return new Date(date).toLocaleString('tr-TR', {
        dateStyle: 'long',
    });
}

export function dateTimeFormat(date: string): string {
    return new Date(date).toLocaleString('tr-TR');
}
