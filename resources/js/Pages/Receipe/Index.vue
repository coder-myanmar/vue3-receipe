<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Multiselect from "@vueform/multiselect";

const form = useForm({
  name: "",
  ingredients: [],
});

const submit = () => {
  form.post(route("receipe.store"));
  form.name = null;
  form.ingredients = null;
};

const props = defineProps({
  receipes: Array,
});
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

<template>
  <div class="main my-10 mx-20">
    <div class="grid grid-cols-2 gap-10">
      <div>
        <div class="flex flex-col">
          <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
              <div class="overflow-hidden">
                <table class="min-w-full">
                  <thead class="bg-white border-b">
                    <tr>
                      <th
                        scope="col"
                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                      >
                        #
                      </th>
                      <th
                        scope="col"
                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                      >
                        Name
                      </th>
                      <th
                        scope="col"
                        class="text-sm font-medium text-gray-900 px-6 py-4 text-left"
                      >
                        Ingredients
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr
                      v-for="receipe in receipes"
                      :key="receipe.id"
                      class="bg-gray-100 border-b"
                    >
                      <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                      >
                        {{ receipe.id }}
                      </td>
                      <td
                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                      >
                        {{ receipe.name }}
                      </td>
                      <td
                        class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"
                      >
                        <span v-for="data in receipe.ingredients" :key="data">
                          {{ data }} ,
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <h1 class="text-2xl my-5">Create Receipe</h1>

        <form ref="form_1" @submit.prevent="submit">
          <div class="mb-5">
            <InputLabel for="name" value="Name" />

            <TextInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              required
              autofocus
              autocomplete="name"
              placeholder="Receipe Name"
            />

            <InputError class="mt-2" :message="form.errors.name" />
          </div>

          <div>
            <Multiselect
              placeholder="Select your character"
              mode="tags"
              :searchable="true"
              :createTag="true"
              v-model="form.ingredients"
            />

            <InputError class="mt-2" :message="form.errors.ingredients" />
          </div>

          <div class="mt-5">
            <PrimaryButton
              class=""
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              Create
            </PrimaryButton>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>