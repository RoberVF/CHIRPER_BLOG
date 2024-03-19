import React from 'react'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout'
import InputError from '@/Components/InputError'
import PrimaryButton from '@/Components/PrimaryButton'
import {useForm, Head} from '@inertiajs/react'

export default function Index({auth}) {
    const {data, setData, post, processing, reset, errors} = useForm({
        message: ''
    })

    const submit = (e) => {
        e.preventDefault() //Porque se va a usar un form y asi no perdemos el SPA
        post(route('chirps.store'), {onSuccess: () => reset()})
    }

    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Chirps"/>

            <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
                <h2 className='text-2xl mb-2 font-bold'>What are you thinking about?</h2>
                <form onSubmit={submit}>
                    <textarea 
                        value={data.message} 
                        placeholder='Comment Something!'
                        className='block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'
                        onChange={e => setData('message', e.target.value)}
                    ></textarea>
                    <InputError message={errors.message} className='mt-2' />
                    <PrimaryButton className='mt-4' disabled={processing}>Comment!</PrimaryButton>
                </form>
            </div>
        </AuthenticatedLayout>
    )
}