import {User} from '@/types/model';

export interface Toast {
    type: 'success' | 'error' | 'warning' | 'info';
    message: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    toasts: Toast[];
};
